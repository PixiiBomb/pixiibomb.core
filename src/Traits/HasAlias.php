<?php

namespace PixiiBomb\Core\Traits;

use Illuminate\Support\Str;
use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Layouts\Layout;

/**
 * Provides an optional alias that can be assigned to an object.
 *
 * Aliases allow an object to be referenced by an alternate identifier,
 * such as a template name, lookup key, or user-defined reference.
 */
trait HasAlias
{
    /**
     * The optional alias assigned to the object.
     */
    protected ?string $alias = null;

    /**
     * Gets the alias assigned to the object.
     *
     * @return string|null The alias, or null if one has not been assigned.
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * Sets the alias assigned to the object.
     * Non-null aliases are normalized to kebab case.
     *
     * @param string|null $alias The alias, or null to remove it.
     *
     * @return HasAlias|Block|Layout Returns the current instance for method chaining.
     */
    public function setAlias(?string $alias): self
    {
        $this->alias = $alias === null
            ? null
            : Str::kebab($alias);

        return $this;
    }
}
