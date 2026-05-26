<?php

namespace PixiiBomb\Core\Schemas;

class ThemeSchema extends Schema
{
    public static function default(): object
    {
        return self::schema(
            required: [
                'display_name',
                'folder_name',
            ],
            properties: [
                'display_name' => [
                    'type' => 'string',
                    'maxLength' => 255,
                ],

                'folder_name' => [
                    'type' => 'string',
                    'maxLength' => 255,
                ],

                'description' => [
                    'type' => ['string', 'null'],
                ],

                'thumbnail_path' => [
                    'type' => ['string', 'null'],
                    'maxLength' => 1024,
                ],

                'default_palette' => [
                    'type' => ['string', 'null'],
                    'maxLength' => 255,
                ],

                'palettes' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'string',
                    ],
                ],

                'is_active' => [
                    'type' => 'boolean',
                ],

                'is_default' => [
                    'type' => 'boolean',
                ],
            ],
        );
    }

    public static function create(): object
    {
        return self::default();
    }

    public static function update(): object
    {
        return self::withoutProperties(
            self::default(),
            [
                'folder_name',
            ]
        );
    }

    public static function patch(): object
    {
        return self::withoutRequired(
            self::update()
        );
    }
}
