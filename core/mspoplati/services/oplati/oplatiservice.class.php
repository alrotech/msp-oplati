<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

require __DIR__ . '/../../vendor/autoload.php';

use alroniks\mspoplati\dto\Payment;
use alroniks\mspoplati\OplatiBridgeInterface;
use alroniks\mspoplati\OplatiGatewayInterface;
use GuzzleHttp\Client;
use Fig\Http\Message\RequestMethodInterface as Method;
use League\Uri\UriTemplate;
use Lmc\HttpConstants\Header;

class OplatiService implements OplatiBridgeInterface
{
    public const PAYMENT_STATUS_IN_PROGRESS = 'in-progress';
    public const PAYMENT_STATUS_OK = 'ok';
    public const PAYMENT_STATUS_DECLINE = 'decline';
    public const PAYMENT_STATUS_NOT_ENOUGH = 'not-enough';
    public const PAYMENT_STATUS_TIMEOUT = 'timeout';

    public const HUMAN_STATUSES_MAP = [
        0 => self::PAYMENT_STATUS_IN_PROGRESS,
        1 => self::PAYMENT_STATUS_OK,
        2 => self::PAYMENT_STATUS_DECLINE,
        3 => self::PAYMENT_STATUS_NOT_ENOUGH,
        4 => self::PAYMENT_STATUS_TIMEOUT,
    ];

    private modX $modx;

    private miniShop2 $minishopService;

    private array $config;

    public function __construct(modX $modx, array $config = [])
    {
        $this->modx = $modx;
        $this->config = $config;

        /** @var miniShop2 $ms */
        $ms = $this->modx->getService('minishop2');
        $this->minishopService = $ms;

        $this->modx->lexicon->load('mspoplati:default');
    }

    protected function getHumanStatus(int $status): string
    {
        if (!array_key_exists($status, static::HUMAN_STATUSES_MAP)) {
            return $this->modx->lexicon('oplati-status-unknown');
        }

        return $this->modx->lexicon('oplati-status-' . static::HUMAN_STATUSES_MAP[$status]);
    }

    /**
     * @param \msOrder $order
     *
     * @return \alroniks\mspoplati\dto\Payment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \League\Uri\Contracts\UriException
     */
    public function processOrderStatus(msOrder $order): Payment
    {
        $payment = $this->requestStatus($order);

        $payment->humanStatus = $this->getHumanStatus($payment->status);

        $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($payment->toArray(), true));

        if (in_array($payment->status, [2,3,4])) {
            $orderStatus = $this->config[OplatiGatewayInterface::OPTION_FAILURE_STATUS];
        }

        if ($payment->status === 1) {
            $orderStatus = $this->config[OplatiGatewayInterface::OPTION_SUCCESS_STATUS];
        }

        if (!empty($orderStatus)) {
            $currentContext = $this->modx->context->get('key');
            $this->modx->switchContext('mgr');
            $this->minishopService->changeOrderStatus($order->get('id'), $orderStatus);
            $this->modx->switchContext($currentContext);
        }

        return $payment;
    }

    /**
     * @throws \JsonException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestPayment(msOrder $order): Payment
    {
        $this->setUpConfig($order);

        $items = array_values(array_map(static fn(msOrderProduct $product) => [
            'type' => 1,
            'name' => $product->get('name'),
            'price' => $product->get('price'),
            'quantity' => $product->get('count'),
            'cost' => $product->get('cost'),
        ], $this->modx->getCollection(msOrderProduct::class, ['order_id' => $order->get('id')])));

        // todo: replace by dto or vo?
        $request = [
            'sum' => $order->get('cost'),
            'orderNumber' => $order->get('id'),
            'details' => [
                'receiptNumber' => $order->get('num'),
                'regNum' => $this->config[OplatiGatewayInterface::OPTION_PRINT_CASH_REGISTER_NUMBER] ? $this->config[self::OPTION_CASH_REGISTER_NUMBER] : '',
                'items' => $items,
                'amountTotal' => $order->get('cost'),
                'title' => $this->config[OplatiGatewayInterface::OPTION_TITLE_TEXT],
                'headerInfo' => $this->config[OplatiGatewayInterface::OPTION_HEADER_TEXT],
                'footerInfo' => $this->config[OplatiGatewayInterface::OPTION_FOOTER_TEXT],
            ],
            'successUrl' => $this->modx->getOption('site_url') . '?' . http_build_query(['result' => 'success', 'msorder' => $order->get('id')]),
            'failureUrl' => $this->modx->getOption('site_url') . '?' . http_build_query(['result' => 'failure', 'msorder' => $order->get('id')]),
        ];

        $response = $this->getClient()->request(Method::METHOD_POST, 'pos/webPayments', [
            'headers' => [
                'regNum' => $this->config[OplatiGatewayInterface::OPTION_CASH_REGISTER_NUMBER],
                'password' => $this->config[OplatiGatewayInterface::OPTION_CASH_PASSWORD],
                Header::CONTENT_TYPE => 'application/json',
            ],
            'json' => $request
        ]);

        return new Payment(
            json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \League\Uri\Contracts\UriException
     */
    public function requestStatus(msOrder $order): Payment
    {
        $this->setUpConfig($order);

        $pid = $order->get('properties')['paymentId'];

        $response = $this->getClient()->request(
            Method::METHOD_GET,
            (string)(new UriTemplate('pos/payments/{pid}'))->expand(['pid' => $pid]),
            [
                'headers' => [
                    'regNum' => $this->config[OplatiGatewayInterface::OPTION_CASH_REGISTER_NUMBER],
                    'password' => $this->config[OplatiGatewayInterface::OPTION_CASH_PASSWORD],
                    Header::CONTENT_TYPE => 'application/json',
                ],
            ]
        );

        return new Payment(
            json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)
        );
    }

    protected function setUpConfig(msOrder $order): void
    {
        /** @var msPayment $payment */
        $payment = $order->getOne('Payment');
        $payment->loadHandler();

        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $this->config = $payment->handler->getProperties($payment);

        if ($this->config[OplatiGatewayInterface::OPTION_DEVELOPER_MODE]) {
            $this->config[OplatiGatewayInterface::OPTION_GATEWAY_URL] = $this->config[OplatiGatewayInterface::OPTION_GATEWAY_URL_TEST];
        }
    }

    protected function getClient(): Client
    {
        return new Client(['base_uri' => $this->config[OplatiGatewayInterface::OPTION_GATEWAY_URL]]);
    }
}
