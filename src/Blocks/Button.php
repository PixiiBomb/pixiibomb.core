<?php

namespace PixiiBomb\Core\Blocks;

use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Core\Enums\ButtonStyle;

class Button extends ComponentBlock
{
    protected ?string $text = null;
    protected bool $disabled = false;

    public function __construct(string $text)
    {
        $this->setText($text);
        $this->setAttribute('type', 'button');

        parent::__construct();
    }

    protected static function getStyleEnum(): string
    {
        return ButtonStyle::class;
    }

    public function getText(): ?string { return $this->text; }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
