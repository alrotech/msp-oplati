<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

if (!class_exists('ConfigurablePaymentHandler')) {
    $path = MODX_CORE_PATH. 'components/mspaymentprops/ConfigurablePaymentHandler.class.php';
    if (is_readable($path)) {
        require_once $path;
    }
}

class Oplati extends ConfigurablePaymentHandler
{
    public const OPTION_kassa_id = '';

    /** @var modX */
    public $modx;

    public function __construct()
    {

    }
}
