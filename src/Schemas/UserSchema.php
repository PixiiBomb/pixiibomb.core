<?php

namespace PixiiBomb\Core\Schemas;

class UserSchema extends Schema
{
    public static function default(): object
    {
        return self::schema(
            required: ['username', 'email', 'password'],
            properties: [
                'role_id' => [
                    'type' => ['integer', 'null'],
                ],
                'username' => [
                    'type' => 'string',
                    'maxLength' => 255,
                ],
                'email' => [
                    'type' => 'string',
                    'format' => 'email',
                    'maxLength' => 255,
                ],
                'password' => [
                    'type' => 'string',
                    'minLength' => 8,
                    'maxLength' => 255,
                ],
                'avatar' => [
                    'type' => ['string', 'null'],
                    'maxLength' => 255,
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
            ['password']
        );
    }

    public static function patch(): object
    {
        return self::withoutRequired(
            self::update()
        );
    }

    public static function avatar(): object
    {
        return self::schema(
            required: ['avatar'],
            properties: [
                'avatar' => [
                    'type' => 'string',
                    'maxLength' => 255,
                ],
            ],
        );
    }
}
