<?php

namespace PixiiBomb\Core\Enums;

enum Strings: string
{
    case VIEW = 'view';
    case WIDGET = 'widget';
    case COMPONENT = 'component';
    case PIXII = 'pixii';
    case DEBUG = 'debug';
    case TITLE = 'title';
    case DESCRIPTION = 'description';
    case AUTHOR = 'author';
    case KEYWORDS = 'keywords';
    case AVATAR = 'avatar';
    case BLOCK = 'block';
    case PRIMARY = 'primary';

    case USERNAME = 'username';
    case PASSWORD = 'password';
    case EMAIL = 'email';
    case ROLE = 'role';

    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';

    /**
     * Get all cases as an array of values.
     */
    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }
}
