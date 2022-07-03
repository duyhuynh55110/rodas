<?php

return [
    // mix
    'mix' => env('ASSETS_MIX', false),

    // assets version
    'version' => env('ASSETS_VERSION', microtime(true)),

    // asset manager class
    'assets_manager' => Base\Assets\AssetsManager::class
];
