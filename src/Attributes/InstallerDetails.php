<?php

namespace PixiiBomb\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
readonly class InstallerDetails
{
    public function __construct(public string $package, public int $priority = 0, public ?string $icon = null)
    {}
}
