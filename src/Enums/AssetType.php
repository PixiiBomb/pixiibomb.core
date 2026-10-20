<?php

namespace PixiiBomb\Core\Enums;

enum AssetType: string
{
    case Stylesheet = 'css';
    case Script = 'js';

    public function getDirectory(): string
    {
        return $this->value;
    }

    public function getExtension(): string
    {
        return $this->value;
    }
}
