<?php

namespace PixiiBomb\Core\Layouts;

class CoreLayout extends Layout
{
    protected ?string $defaultView = 'core-layout';

    public function __construct()
    {
        parent::__construct();
        $this->setView($this->defaultView);
    }
}
