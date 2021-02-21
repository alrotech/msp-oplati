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
    Oplati::OPTION_AREA_CREDENTIALS => [
//        Oplati::OPTION_CASH_REGISTER_NUMBER => ['xtype' => 'textfield', 'value' => 'OPL000000985'],
//        Oplati::OPTION_CASH_PASSWORD => ['xtype' => 'text-password', 'value' => 'Modx12345'],
        Oplati::OPTION_CASH_REGISTER_NUMBER => ['xtype' => 'textfield', 'value' => ''],
        Oplati::OPTION_CASH_PASSWORD => ['xtype' => 'text-password', 'value' => ''],
    ],
    Oplati::OPTION_AREA_GATEWAYS => [
        Oplati::OPTION_GATEWAY_URL => ['xtype' => 'textfield', 'value' => 'https://cashboxapi.o-plati.by/ms-pay/'],
        Oplati::OPTION_GATEWAY_URL_TEST => ['xtype' => 'textfield', 'value' => 'https://bpay-testcashdesk.lwo.by/ms-pay/'],
        Oplati::OPTION_DEVELOPER_MODE => ['xtype' => 'combo-boolean', 'value' => true],
    ],
    Oplati::OPTION_AREA_RECEIPT => [
        Oplati::OPTION_TITLE_TEXT => ['xtype' => 'textfield', 'value' => ''],
        Oplati::OPTION_HEADER_TEXT => ['xtype' => 'textfield', 'value' => ''],
        Oplati::OPTION_FOOTER_TEXT => ['xtype' => 'textfield', 'value' => ''],
        Oplati::OPTION_PRINT_CASH_REGISTER_NUMBER => ['xtype' => 'combo-boolean', 'value' => false],
    ],
    Oplati::OPTION_AREA_STATUSES => [
        Oplati::OPTION_SUCCESS_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 2],
        Oplati::OPTION_FAILURE_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 4],
    ],
    Oplati::OPTION_AREA_PAGES => [
        Oplati::OPTION_SUCCESS_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
        Oplati::OPTION_FAILURE_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
        Oplati::OPTION_UNPAID_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
    ]
];

$settings = [];
foreach ($list as $area => $set) {
    foreach ($set as $key => $config) {
        $setting = $xpdo->newObject(modSystemSetting::class);
        $setting->fromArray(array_merge([
            'key' => Oplati::getPrefix() . '_' . $key,
            'area' => Oplati::getPrefix() . '_' . $area,
            'namespace' => PKG_NAME_LOWER,
        ], $config), '', true, true);

        $settings[] = $setting;
    }
}

return $settings;
