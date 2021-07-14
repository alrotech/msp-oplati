<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var xPDO $xpdo */

class msPaymentHandler {}
class ConfigurablePaymentHandler {}

require_once __DIR__ . '/../../core/mspoplati/services/oplati/OplatiService.class.php';

$list = [
    OplatiService::OPTION_AREA_CREDENTIALS => [
        OplatiService::OPTION_CASH_REGISTER_NUMBER => ['xtype' => 'textfield', 'value' => ''],
        OplatiService::OPTION_CASH_PASSWORD => ['xtype' => 'text-password', 'value' => ''],
    ],
    OplatiService::OPTION_AREA_GATEWAYS => [
        OplatiService::OPTION_GATEWAY_URL => ['xtype' => 'textfield', 'value' => 'https://cashboxapi.o-plati.by/ms-pay/'],
        OplatiService::OPTION_GATEWAY_URL_TEST => ['xtype' => 'textfield', 'value' => 'https://bpay-testcashdesk.lwo.by/ms-pay/'],
        OplatiService::OPTION_DEVELOPER_MODE => ['xtype' => 'combo-boolean', 'value' => true],
    ],
    OplatiService::OPTION_AREA_RECEIPT => [
        OplatiService::OPTION_TITLE_TEXT => ['xtype' => 'textfield', 'value' => ''],
        OplatiService::OPTION_HEADER_TEXT => ['xtype' => 'textfield', 'value' => ''],
        OplatiService::OPTION_FOOTER_TEXT => ['xtype' => 'textfield', 'value' => ''],
        OplatiService::OPTION_PRINT_CASH_REGISTER_NUMBER => ['xtype' => 'combo-boolean', 'value' => false],
    ],
    OplatiService::OPTION_AREA_STATUSES => [
        OplatiService::OPTION_SUCCESS_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 2],
        OplatiService::OPTION_FAILURE_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 4],
    ],
    OplatiService::OPTION_AREA_PAGES => [
        OplatiService::OPTION_SUCCESS_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
        OplatiService::OPTION_FAILURE_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
        OplatiService::OPTION_UNPAID_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
    ]
];

$settings = [];
foreach ($list as $area => $set) {
    foreach ($set as $key => $config) {
        $setting = $xpdo->newObject(modSystemSetting::class);
        $setting->fromArray(array_merge([
            'key' =>  'oplati_' . $key,
            'area' => 'oplati_' . $area,
            'namespace' => PKG_NAME_LOWER,
        ], $config), '', true, true);

        $settings[] = $setting;
    }
}

return $settings;
