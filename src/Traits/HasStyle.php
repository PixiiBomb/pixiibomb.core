<?php

namespace PixiiBomb\Core\Traits;

use BackedEnum;
use InvalidArgumentException;
use PixiiBomb\Core\Enums\Strings;

trait HasStyle
{
    protected string $style = Strings::PRIMARY->value;

    /**
     * @return class-string<BackedEnum>
     */
    abstract protected static function getStyleEnum(): string;

    public function getStyle(): string { return $this->style; }

    public function setStyle(string|BackedEnum $style): self
    {
        $value = $style instanceof BackedEnum
            ? $style->value
            : $style;

        $enumClass = static::getStyleEnum();

        if ($enumClass::tryFrom($value) === null) {
            throw new InvalidArgumentException("Invalid style [$value] for " . static::class);
        }

        $this->style = $value;

        return $this;
    }
}
