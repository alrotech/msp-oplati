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
    private modX $modx;

    private array $config;

    public function __construct(modX $modx, array $config = [])
    {
        $this->modx = $modx;
        $this->config = $config;

        $this->modx->lexicon->load('mspoplati:default');
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

    public function requestStatus(msOrder $order): Payment
    {
        $this->setUpConfig($order);

        // fetch paymentId from the order

        $response = $this->getClient()->request(
            Method::METHOD_GET,
            (new UriTemplate('pos/payments/{pid}'))->expand(['pid' => 16703])
        );
    }

    protected function setUpConfig(msOrder $order): void
    {
        /** @var msPayment $payment */
        $payment = $order->getOne('Payment');
        $payment->loadHandler();

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
