<?php

namespace PixiiBomb\Core\Data;

use Illuminate\Support\Str;
use PixiiBomb\Core\Traits\HasAttributes;

/**
 * Base class for all renderable PixiiBomb UI components.
 *
 * Component blocks represent reusable UI elements that are rendered through a
 * Blade view. Each component is automatically assigned a unique HTML ID,
 * resolves its default view based on its class name, and provides support for
 * HTML attributes, styles, and content validation.
 */
abstract class ComponentBlock extends Block
{
    use HasAttributes;

    /**
     * The base view directory for all component views.
     */
    protected const string DIRECTORY = 'blocks';

    /**
     * Creates a new component instance.
     *
     * A unique HTML ID is generated automatically, and the component's default
     * view is resolved from its class name.
     */
    public function __construct()
    {
        $this->setId($this->createUniqueId());
        $this->setView($this->getDefaultView());
        $this->defineClasses();
    }

    /**
     * Gets the component's class name formatted for use in view names and IDs.
     *
     * @return string The kebab-case class name.
     */
    public function getClassName(): string
    {
        return Str::kebab(class_basename(static::class));
    }

    /**
     * Gets the default Blade view for the component.
     *
     * The view name is generated from the component's class name and the
     * configured component directory.
     *
     * @return string The default view name.
     */
    protected function getDefaultView(): string
    {
        $directory = self::DIRECTORY;
        $classname = $this->getClassName();

        return "$directory.$classname";
    }

    /**
     * Creates a unique HTML ID for the component instance.
     *
     * @return string A unique component ID.
     */
    protected function createUniqueId(): string
    {
        $classname = $this->getClassName();
        $objectId = spl_object_id($this);

        return Str::kebab("$classname-$objectId");
    }
}
