<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var modX $modx */
/** @var array $scriptProperties */

# Options
$orderId = $modx->getOption('msorder', $scriptProperties, $_GET['msorder']);
$tpl = $modx->getOption('tpl', $scriptProperties, 'qrcode');

$size = $modx->getOption('size', $scriptProperties, '200');
$fill = $modx->getOption('fillColor', $scriptProperties, 'ffffff');
$path = $modx->getOption('pathColor', $scriptProperties, '000000');

// частота обновлений?

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

$qrCode =  $paymentHandler->getQuickResponseCode($order);

# View the code

$assetsUrl = $modx->getOption('assets_url');

$modx->regClientScript($assetsUrl . 'components/mspoplati/js/qrcode.min.js');
$modx->regClientScript($assetsUrl . 'components/mspoplati/js/oplati.app.js');
$modx->regClientCSS($assetsUrl . 'components/mspoplati/css/oplati.app.css');

return $modx->getChunk($tpl, [
    'code' => $qrCode,
    'fill' => $fill,
    'path' => $path,
]);

// сниппет вывел блок - показываем код и ставим таймер
// - по таймеру ходим на сервер, валидируем оплату,
// если нет - выдаем статусы под кодом
// если да - прячем код, говорим что все хорошо, вернуться на сайт?


// скрипт в свою очередь показывает кнопку и рисует сам код по данным, скрипт можно подключать любой по инструкции
// далее тот же скрипт делает запрос на сервер с целью проверки платежа и меняет статус если нужно
// если время ожидания вышло, то нужно повторить запрос на перегенерацию кода
// обе операции следует делать через процессоры, и вызывать их в том числе и в снипете
// так же можно предусмотреть опционально добавление срипта проверки в cron
//
// в админке следует предусмотреть кнопку для проверки статуса платежа заказа, если он был через оплати
// следовательно, нужно иметь возможность проверить все такие заказы за один проход - крон?
//
// так же следует реализовать механизм сверки по кассе в конце дня - в след версиях
// так же нужно иметь возможность вернуть деньги в течение текущего бизнес-дня - в следующих версиям
