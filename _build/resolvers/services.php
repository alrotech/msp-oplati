<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

/** @var xPDOTransport $transport */
/** @var array $options */

if (!$transport->xpdo && !$transport->xpdo instanceof modX) {
    return true;
}

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        $transport->xpdo->addExtensionPackage('oplati', '[[++core_path]]components/mspoplati/services/');

        /** @var miniShop2 $shop */
        if ($shop = $transport->xpdo->getService('miniShop2')) {
            $shop->addService('payment', OplatiHandler::class, '{core_path}components/mspoplati/OplatiHandler.class.php');
        }

        break;

    case xPDOTransport::ACTION_UNINSTALL:

        $transport->xpdo->removeExtensionPackage('oplati');

        /** @var miniShop2 $shop */
        if ($shop = $transport->xpdo->getService('miniShop2')) {
            $shop->removeService('payment', OplatiHandler::class);
        }

        break;
}
