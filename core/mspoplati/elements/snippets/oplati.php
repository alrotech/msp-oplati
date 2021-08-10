<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var modX $modx */
/** @var array $scriptProperties */

$componentPath = $modx->getOption(
    'mspoplati.core_path',
    null,
    $modx->getOption('core_path') . 'components/mspoplati/'
);

require $componentPath . 'vendor/autoload.php';

# Options

$oid = $modx->getOption('oid', $scriptProperties);
$tpl = $modx->getOption('tpl', $scriptProperties, 'qrcode');

$size = $modx->getOption('size', $scriptProperties, '200');
$fill = $modx->getOption('fillColor', $scriptProperties, 'ffffff');
$path = $modx->getOption('pathColor', $scriptProperties, '000000');

if (!$oid) {
    $oid = (int)$_GET['msorder'];
}

# Order handling

/** @var msOrder $order */
$order = $modx->getObject(msOrder::class, ['id' => $oid]);

$payment = $modx->getService('oplati', OplatiService::class)->requestPayment($order);

$order->set('properties', array_merge($order->get('properties') ?? [], $payment->toArray()));
$order->save();

# View the code

$assetsUrl = $modx->getOption('assets_url');

// путь к js? - системные настройки онли?
// путь к css? - системные настройки онли?

$noCache = bin2hex(random_bytes(4));
$modx->regClientScript($assetsUrl . 'components/mspoplati/app/oplati.app.js?nocache=' . $noCache);
$modx->regClientCSS($assetsUrl . 'components/mspoplati/styles/oplati.app.css?nocache=' . $noCache);

return $modx->getChunk(
    $tpl,
    array_merge($order->toArray(), [
        'code' => $payment->dynamicQR,
        'fill' => $fill,
        'path' => $path,
        'size' => $size,
        'oid' => $oid,
    ])
);
