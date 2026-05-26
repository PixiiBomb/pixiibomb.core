<?php

namespace PixiiBomb\Core\Traits;

trait HasAlias
{
    /** ------------------------------------------------------------------------------------------ @region PROPERTIES */
    protected ?string $alias = null;

    /** --------------------------------------------------------------------------------------------- @region GETTERS */
    public function getAlias(): ?string { return $this->alias; }

    /** --------------------------------------------------------------------------------------------- @region SETTERS */
    public function setAlias(?string $alias): self {
        $this->alias = $alias;
        return $this;
    }
}
