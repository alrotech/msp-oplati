<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

/** @var xPDOTransport $transport */
/** @var array $options */

if (!$transport->xpdo) {
    return false;
}

$version_data = $transport->xpdo->getVersionData();
$version = implode('.', [$version_data['version'], $version_data['major_version'], $version_data['minor_version']]);

if (!version_compare($version, '2.8', '>=')) {
    $transport->xpdo->log(modX::LOG_LEVEL_ERROR, 'Invalid MODX version. Minimal supported version is 2.8.');

    return false;
}

return true;
