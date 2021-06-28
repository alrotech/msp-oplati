<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var xPDOTransport $transport */
/** @var array $options */

if (!$transport->xpdo && !$transport->xpdo instanceof modX) {
    return true;
}

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        /** @var miniShop2 $shop */
        if ($shop = $transport->xpdo->getService('miniShop2')) {
            $shop->addService('payment', Oplati::class, '{core_path}components/mspoplati/Oplati.class.php');
        }

        break;

    case xPDOTransport::ACTION_UNINSTALL:

        /** @var miniShop2 $shop */
        if ($shop = $transport->xpdo->getService('miniShop2')) {
            $shop->removeService('payment', Oplati::class);
        }

        break;
}
