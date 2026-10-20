<?php

namespace PixiiBomb\Core\Support;

use Illuminate\Support\Str;

class PixiiUtilities
{
    public static function formatComponentName(string $classname, bool $fromPackage = true): string
    {
        $prefix = $fromPackage ? 'pixii::' : '';
        $suffix = Str::kebab(class_basename($classname));
        return "{$prefix}{$suffix}";
    }
}
