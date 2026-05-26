<?php

namespace PixiiBomb\Core\Data;

use Illuminate\Support\Str;
use PixiiBomb\Core\Traits\{HasAttributes, HasStyle};

abstract class ComponentBlock extends Block
{
    use HasAttributes;
    use HasStyle;

    protected const string DIRECTORY = 'components';
    protected const string YIELD_INDICATOR = '*';

    public function __construct()
    {
        $this->setId($this->createUniqueId());
        $this->setView($this->getDefaultView());
    }

    protected function getDefaultView(): string
    {
        $directory = self::DIRECTORY;
        $classname = $this->getClassName();
        return "$directory.$classname";
    }

    public function getClassName(): string
    {
        return Str::kebab(class_basename(static::class));
    }

    protected function createUniqueId(): string
    {
        $classname = $this->getClassName();
        $object_id = spl_object_id($this);
        return Str::kebab("$classname-$object_id");
    }
}
