<?php

use Composer\InstalledVersions;

$package = 'pixiibomb/core';

return [
    'version' => InstalledVersions::isInstalled($package) ? InstalledVersions::getPrettyVersion($package) : null,

    'include-site-name-in-title' => true,

    'openai' => [
        'key' => env('OPENAI_API_KEY'),
        'dev_model' => env('OPENAI_DEV_MODEL'),
        'prod_model' => env('OPENAI_PROD_MODEL'),
    ],
];
