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

        $transport->xpdo->newObject(
            msPayment::class,
            [
                'name' => 'Oplati',
                'description' => null,
                'price' => 0,
//                'logo' => MODX_ASSETS_URL . 'components/mspoplati/oplati-logo-black.svg',
                'rank' => 0,
                'active' => 1,
                'class' => OplatiHandler::class,
                'properties' => null // todo: setup minimal default properties
            ]
        )->save();

        break;

    case xPDOTransport::ACTION_UNINSTALL:

        $transport->xpdo->removeObject(msPayment::class, ['class' => OplatiHandler::class]);

        break;
}
