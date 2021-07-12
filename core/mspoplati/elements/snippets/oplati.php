<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var modX $modx */
/** @var array $scriptProperties */

// todo: move it to the service and get service in the snippet
$modx->getService('lexicon', modLexicon::class);
$modx->lexicon->load('mspoplati:default');

# Options

$orderId = $modx->getOption('msorder', $scriptProperties, $_GET['msorder']);
$tpl = $modx->getOption('tpl', $scriptProperties, 'qrcode');

$size = $modx->getOption('size', $scriptProperties, '200');
$fill = $modx->getOption('fillColor', $scriptProperties, 'ffffff');
$path = $modx->getOption('pathColor', $scriptProperties, '000000');

// путь к js? - системные настройки онли?
// путь к css? - системные настройки онли?

# Order handling

/** @var msOrder $order */
$order = $modx->getObject(msOrder::class, ['id' => $orderId]);

/** @var msPayment $payment */
$payment = $order->getOne('Payment');
$payment->loadHandler();

/** @var Oplati $paymentHandler */
$paymentHandler = $payment->handler;

$code = $paymentHandler->getQuickResponseCode($order);

# View the code

$assetsUrl = $modx->getOption('assets_url');

$modx->regClientScript($assetsUrl . 'components/mspoplati/app/qrcode.min.js');
$modx->regClientScript($assetsUrl . 'components/mspoplati/app/oplati.app.js');
$modx->regClientCSS($assetsUrl . 'components/mspoplati/styles/oplati.app.css');

return $modx->getChunk($tpl, [
    'code' => $code,
    'fill' => $fill,
    'path' => $path,
    'size' => $size
]);
