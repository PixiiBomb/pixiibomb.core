<?php

namespace PixiiBomb\Core\Validation;

use PixiiBomb\Core\Enums\Action;

class ThemeValidation extends ResourceValidation
{
    protected static function fields(): array
    {
        return [
            'display_name' => ['string', 'max:255'],
            'folder_name' => ['string', 'max:255'],
            'description' => ['string'],
            'thumbnail_path' => ['string', 'max:1024'],
            'default_palette' => ['string', 'max:255'],
            'palettes' => ['array'],
            'palettes.*' => ['string'],
            'is_active' => ['boolean'],
            'is_default' => ['boolean'],
        ];
    }

    protected static function requiredFor(Action $action): array
    {
        return match ($action) {
            Action::CREATE => [
                'display_name',
                'folder_name',
            ],

            Action::UPDATE => [
                'display_name',
            ],

            default => [],
        };
    }
}
