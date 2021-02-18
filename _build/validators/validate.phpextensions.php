<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2019
 */

declare(strict_types = 1);

/** @var xPDOTransport $transport */
/** @var array $options */

if (!$transport->xpdo) {
    return false;
}

if (!extension_loaded('bcmath')) {
    $transport->xpdo->log(modX::LOG_LEVEL_ERROR, 'Extension BC Math (http://php.net/manual/en/book.bc.php) does not loaded. This extension is required for accurate calculations of money amounts.');

    return false;
}

return true;
