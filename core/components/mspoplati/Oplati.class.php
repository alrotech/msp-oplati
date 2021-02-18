<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

if (!class_exists('ConfigurablePaymentHandler')) {
    $path = MODX_CORE_PATH. 'components/mspaymentprops/ConfigurablePaymentHandler.class.php';
    if (is_readable($path)) {
        require_once $path;
    }
}

class Oplati extends ConfigurablePaymentHandler
{
    public const OPTION_CASH_REGISTER_NUMBER = 'cash_register_number';
    public const OPTION_CASH_PASSWORD = 'cash_password';

    public const OPTION_GATEWAY_URL = 'gateway_url';
    public const OPTION_GATEWAY_URL_TEST = 'gateway_url_test';
    public const OPTION_DEVELOPER_MODE = 'developer_mode';

    public const OPTION_SUCCESS_STATUS = 'success_status';
    public const OPTION_FAILURE_STATUS = 'failure_status';
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

    public function getPaymentLink(msOrder $order)
    {
        /** @var msPayment $payment */
        $payment = $order->getOne('Payment');

        /** @var msDelivery $delivery */
        $delivery = $order->getOne('Delivery');

        /** @var modUser $user */
        $user = $order->getOne('User');

        if ($user) {
            /** @var modUserProfile $user */
            $user = $user->getOne('Profile');
        }

        $this->config = $this->getProperties($payment);
        $this->adjustCheckoutUrls();


        // нужно сходить на сервер и получить qr-код или ссылку.
        // нужно показать окно для оплаты, куда передать параметры платежа
        // там вызвать снипет на странице, где показывать код или ссылку
        // и сделать обновление регулярное через js-скрипты

        return 'https://modx.by';

    }

    public function adjustCheckoutUrls(): void
    {
        if ($this->config[self::OPTION_DEVELOPER_MODE]) {
            $this->config[self::OPTION_GATEWAY_URL] = $this->config[self::OPTION_GATEWAY_URL_TEST];
        }
    }
}
