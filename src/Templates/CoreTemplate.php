<?php

namespace PixiiBomb\Core\Templates;

class CoreTemplate extends Template
{
    protected ?string $defaultView = 'core-template';

    public function __construct()
    {
        $this->setView($this->defaultView);
    }
}
