<?php

namespace PixiiBomb\Core\Controllers\Api;

use PixiiBomb\Core\Models\Theme;
use PixiiBomb\Core\Schemas\ThemeSchema;

class ThemeController extends ApiController
{
    protected function model(): string
    {
        return Theme::class;
    }

    protected function schema(): string
    {
        return ThemeSchema::class;
    }
}
