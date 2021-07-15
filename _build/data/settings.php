<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

/** @var xPDO $xpdo */

require __DIR__ . '/../../core/mspoplati/OplatiGatewayInterface.php';

use alroniks\mspoplati\OplatiGatewayInterface;

$list = [
    OplatiGatewayInterface::AREA_CREDENTIALS => [
        OplatiGatewayInterface::OPTION_CASH_REGISTER_NUMBER => ['xtype' => 'textfield', 'value' => ''],
        OplatiGatewayInterface::OPTION_CASH_PASSWORD => ['xtype' => 'text-password', 'value' => ''],
    ],
    OplatiGatewayInterface::AREA_GATEWAYS => [
        OplatiGatewayInterface::OPTION_GATEWAY_URL => ['xtype' => 'textfield', 'value' => 'https://cashboxapi.o-plati.by/ms-pay/'],
        OplatiGatewayInterface::OPTION_GATEWAY_URL_TEST => ['xtype' => 'textfield', 'value' => 'https://bpay-testcashdesk.lwo.by/ms-pay/'],
        OplatiGatewayInterface::OPTION_DEVELOPER_MODE => ['xtype' => 'combo-boolean', 'value' => true],
    ],
    OplatiGatewayInterface::AREA_RECEIPT => [
        OplatiGatewayInterface::OPTION_TITLE_TEXT => ['xtype' => 'textfield', 'value' => ''],
        OplatiGatewayInterface::OPTION_HEADER_TEXT => ['xtype' => 'textfield', 'value' => ''],
        OplatiGatewayInterface::OPTION_FOOTER_TEXT => ['xtype' => 'textfield', 'value' => ''],
        OplatiGatewayInterface::OPTION_PRINT_CASH_REGISTER_NUMBER => ['xtype' => 'combo-boolean', 'value' => false],
    ],
    OplatiGatewayInterface::AREA_STATUSES => [
        OplatiGatewayInterface::OPTION_SUCCESS_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 2],
        OplatiGatewayInterface::OPTION_FAILURE_STATUS => ['xtype' => 'mspp-combo-status', 'value' => 4],
    ],
    OplatiGatewayInterface::AREA_PAGES => [
        OplatiGatewayInterface::OPTION_SUCCESS_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
        OplatiGatewayInterface::OPTION_FAILURE_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
        OplatiGatewayInterface::OPTION_UNPAID_PAGE => ['xtype' => 'mspp-combo-resource', 'value' => 0],
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
