<?php

namespace PixiiBomb\Core\Schemas;

class RoleSchema extends Schema
{
    public static function default(): object
    {
        return self::schema(
            required: ['key', 'display_name'],
            properties: [
                'key' => [
                    'type' => 'string',
                    'maxLength' => 255,
                ],
                'display_name' => [
                    'type' => 'string',
                    'maxLength' => 255,
                ],
                'description' => [
                    'type' => ['string', 'null'],
                ],
                'priority' => [
                    'type' => 'integer',
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
            ['key']
        );
    }

    public static function patch(): object
    {
        return self::withoutRequired(
            self::update()
        );
    }

}
