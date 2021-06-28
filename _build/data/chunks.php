<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var xPDO $xpdo */

$list = [
    'qrcode' => [
        'description' => 'Template with QR code data'
    ],
];

$chunks = [];

foreach ($list as $k => $v) {
    $code = file_get_contents(dirname(__DIR__, 2) . '/core/mspoplati/elements/chunks/' . $k . '.tpl');
    $chunk = $xpdo->newObject(modChunk::class);
    $chunk->fromArray([
        'id' => 0,
        'name' => $k,
        'category' => 0,
        'description' => $v['description'],
        'snippet' => trim(str_replace(['<?php', '?>'], '', $code)),
        'static' => true,
        'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/chunks/' . $k . '.tpl',
        'source' => 1,
        'property_preprocess' => 0,
        'editor_type' => 0,
        'cache_type' => 0
  ]);

    $chunks[] = $chunk;
}

return $chunks;
