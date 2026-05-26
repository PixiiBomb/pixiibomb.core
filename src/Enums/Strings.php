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
    case BLOCK = 'block';
    case PRIMARY = 'primary';

    /**
     * Get all cases as an array of values.
     */
    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }
}
