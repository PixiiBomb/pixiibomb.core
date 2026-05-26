<?php

namespace PixiiBomb\Core\Data;

class MenuItem
{
    public function __construct(public string $label, public string $route = '#', public bool $active = false)
    {
    }
}
