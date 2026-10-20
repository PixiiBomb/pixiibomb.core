<?php

namespace PixiiBomb\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
readonly class Installer
{
    public function __construct(public bool $isRequired, public ?string $description = null) {
    }
}
