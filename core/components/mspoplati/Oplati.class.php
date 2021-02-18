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

    /** @var modX */
    public $modx;

    public function __construct()
    {

    }

    public static function getPrefix(): string
    {
        return strtolower(__CLASS__);
    }
}
