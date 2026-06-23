<?php

namespace PixiiBomb\Core\Controllers\Api;

use PixiiBomb\Core\Models\Theme;
use PixiiBomb\Core\Validation\ThemeValidation;

class ThemeController extends ApiController
{
    protected function model(): string
    {
        return Theme::class;
    }

    protected function validator(): string
    {
        return ThemeValidation::class;
    }
}
