<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

use GuzzleHttp\Client;
use Fig\Http\Message\RequestMethodInterface as Method;
use Lmc\HttpConstants\Header;

require_once __DIR__ . '/vendor/autoload.php';

if (!class_exists('ConfigurablePaymentHandler')) {
    $path = MODX_CORE_PATH. 'components/mspaymentprops/ConfigurablePaymentHandler.class.php';
    if (is_readable($path)) {
        /** @noinspection PhpIncludeInspection */
        require_once $path;
    }
}

class Oplati extends ConfigurablePaymentHandler
{
    public const OPTION_AREA_CREDENTIALS = 'credentials';
    public const OPTION_CASH_REGISTER_NUMBER = 'cash_register_number';
    public const OPTION_CASH_PASSWORD = 'cash_password';

    public const OPTION_AREA_GATEWAYS = 'gateways';
    public const OPTION_GATEWAY_URL = 'gateway_url';
    public const OPTION_GATEWAY_URL_TEST = 'gateway_url_test';
    public const OPTION_DEVELOPER_MODE = 'developer_mode';

    public const OPTION_AREA_RECEIPT = 'receipt';
    public const OPTION_TITLE_TEXT = 'title_text';
    public const OPTION_HEADER_TEXT = 'receipt_header_text';
    public const OPTION_FOOTER_TEXT = 'receipt_footer_text';
    public const OPTION_PRINT_CASH_REGISTER_NUMBER = 'print_crn';

    public const OPTION_AREA_STATUSES = 'statuses';
    public const OPTION_SUCCESS_STATUS = 'success_status';
    public const OPTION_FAILURE_STATUS = 'failure_status';

    public const OPTION_AREA_PAGES = 'pages';
    public const OPTION_SUCCESS_PAGE = 'success_page';
    public const OPTION_FAILURE_PAGE = 'failure_page';
    public const OPTION_UNPAID_PAGE = 'unpaid_page';

    public function __construct(xPDOObject $object, array $config = [])
    {
        parent::__construct($object, $config);

        $this->config = $config;
    }

    public static function getPrefix(): string
    {
        return strtolower(__CLASS__);
    }

    public function send(msOrder $order)
    {
        if (!$link = $this->getPaymentLink($order)) {
            return $this->error('Token and redirect url can not be requested. Please, look at error log.');
        }

        return $this->success('', ['redirect' => $link]);
    }

    /**
     * @throws \ReflectionException
     */
    public function getPaymentLink(msOrder $order): string
    {
        /** @var msPayment $payment */
        $payment = $order->getOne('Payment');

        $this->config = $this->getProperties($payment);

        return $this->modx->makeUrl(
            $this->config[self::OPTION_UNPAID_PAGE],
            $this->modx->context->get('key'),
            modX::toQueryString(['msorder' => $order->get('id')]),
            'full'
        );
    }

    /**
     * @throws \JsonException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getQuickResponseCode(msOrder $order): string
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
                'regNum' => $this->config[self::OPTION_PRINT_CASH_REGISTER_NUMBER] ? $this->config[self::OPTION_CASH_REGISTER_NUMBER] : '',
                'items' => $items,
                'amountTotal' => $order->get('cost'),
                'title' => $this->config[self::OPTION_TITLE_TEXT],
                'headerInfo' => $this->config[self::OPTION_HEADER_TEXT],
                'footerInfo' => $this->config[self::OPTION_FOOTER_TEXT],
            ],
            'successUrl' => $this->modx->getOption('site_url') . '?' . http_build_query(['result' => 'success', 'msorder' => $order->get('id')]),
            'failureUrl' => $this->modx->getOption('site_url') . '?' . http_build_query(['result' => 'failure', 'msorder' => $order->get('id')]),
        ];

        $response = $this->getClient()->request(Method::METHOD_POST, 'pos/webPayments', [
            'headers' => [
                'regNum' => $this->config[self::OPTION_CASH_REGISTER_NUMBER],
                'password' => $this->config[self::OPTION_CASH_PASSWORD],
                Header::CONTENT_TYPE => 'application/json',
            ],
            'json' => $request
        ]);

        $answer = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

//        print_r($answer);

        // need to return paymentID as well

        return $answer['dynamicQR'];
    }

    public function checkPaymentStatus(msOrder $order)
    {
        $this->setUpConfig($order);

        // 16703
//        $response = $this->getClient()->request(Method::METHOD_GET, 'pos/payments/{}', [
//
//        ]);

    }

    // todo: move to the payment props
    protected function adjustCheckoutUrls(): void
    {
        if ($this->config[self::OPTION_DEVELOPER_MODE]) {
            $this->config[self::OPTION_GATEWAY_URL] = $this->config[self::OPTION_GATEWAY_URL_TEST];
        }
    }

    protected function setUpConfig(msOrder $order): void
    {
        /** @var msPayment $payment */
        $payment = $order->getOne('Payment');

        $this->config = $this->getProperties($payment);
        $this->adjustCheckoutUrls();
    }

    protected function getClient(): Client
    {
        return new Client(['base_uri' => $this->config[self::OPTION_GATEWAY_URL]]);
    }
}
