<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

/** @var xPDO $xpdo */

$list = [
    'oplati' => [
        'description' => 'Snippet for requesting payment data and generating the QR-code',
        'properties' => [
            'oid' => [
                'type' => 'numberfield',
                'value' => ''
            ],
            'tpl' => [
                'type' => 'textfield',
                'value' => 'qrcode'
            ],
            'size' => [
                'type' => 'numberfield',
                'value' => 200
            ],
            'fillColor' => [
                'type' => 'textfield',
                'value' => 'ffffff'
            ],
            'pathColor' => [
                'type' => 'textfield',
                'value' => '000000'
            ]
        ]
    ],
];

$snippets = [];
foreach ($list as $k => $v) {
    $code = file_get_contents(dirname(__DIR__, 2) . '/core/mspoplati/elements/snippets/'. $k . '.php');
    $snippet = $xpdo->newObject(modSnippet::class);
    $snippet->fromArray([
       'id' => 0,
       'name' => $k,
       'category' => 0,
       'description' => $v['description'],
       'snippet' => trim(str_replace(['<?php', '?>'], '', $code)),
       'static' => true,
       'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/snippets/' . $k . '.php',
       'source' => 1,
       'property_preprocess' => 0,
       'editor_type' => 0,
       'cache_type' => 0
   ], '', true, true);

    $snippet->setProperties(
        array_map(
            static fn($key, $property) => array_merge(
                [
                    'name' => $key,
                    'desc' => 'oplati-prop-' . $key,
                    'lexicon' => 'mspoplati:properties',
                ],
                $property
            ),
            array_keys($v['properties']),
            $v['properties']
        )
    );

    $snippets[] = $snippet;
}

return $snippets;
