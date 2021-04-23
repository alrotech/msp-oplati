<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

$plugins = [];
foreach ($list as $k => $v) {
    $plugin = new modPlugin($xpdo);
    $plugin->fromArray([
       'id' => 0,
       'name' => $k,
       'category' => 0,
       'description' => $v['description'],
       'plugincode' => trim(str_replace(['<?php', '?>'], '', file_get_contents($sources['plugins'] . $k . '.php'))),
       'static' => true,
       'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/plugins/' . $k . '.php',
       'source' => 1,
       'property_preprocess' => 0,
       'editor_type' => 0,
       'cache_type' => 0
   ], '', true, true);

    $plugins[] = $plugin;
}

return $plugins;
