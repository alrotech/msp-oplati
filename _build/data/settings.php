<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var xPDO $xpdo */

class msPaymentHandler {}
class ConfigurablePaymentHandler {}

require_once dirname(__DIR__, 2) . '/core/components/mspoplati/Oplati.class.php';

$list = [
    Oplati::OPTION_CASH_REGISTER_NUMBER => ['xtype' => 'textfield', 'value' => ''],
    Oplati::OPTION_CASH_PASSWORD => ['xtype' => 'text-password', 'value' => ''],
    Oplati::OPTION_GATEWAY_URL => ['xtype' => 'textfield', 'value' => 'https://cashboxapi.o-plati.by/ms-pay/'],
    Oplati::OPTION_GATEWAY_URL_TEST => ['xtype' => 'textfield', 'value' => 'https://bpay-testcashdesk.lwo.by/ms-pay/'],
    Oplati::OPTION_DEVELOPER_MODE => ['xtype' => 'combo-boolean', 'value' => true],
    Oplati::OPTION_SUCCESS_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 2],
    Oplati::OPTION_FAILURE_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 4],
    Oplati::OPTION_SUCCESS_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
    Oplati::OPTION_FAILURE_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
    Oplati::OPTION_UNPAID_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
];


$settings = [];
foreach ($list as $k => $v) {
    $setting = $xpdo->newObject(modSystemSetting::class);
    $setting->fromArray(array_merge([
        'key' => Oplati::getPrefix() . '_' . $k,
        'namespace' => PKG_NAME_LOWER,
    ], $v), '', true, true);

    $settings[] = $setting;
}

return $settings;
