<?php

namespace PixiiBomb\Core\Blocks;

use PixiiBomb\Core\Data\Block;

class Alert extends Block {

    protected array $styles = ['primary', 'secondary', 'success', 'danger', 'warning', 'note'];

    protected ?string $styleClassname = null;

    /**
     * @param int $style Represents a valid index in `$this->styles` array.
     * @see $this->styles
     */
    public function __construct(protected string $message, protected int $style = 0)
    {
        $this->setView('blocks.components.alert');
        $this->setMessage($message);
        $this->setStyle($style);
    }

    public function getStyle(): int { return $this->style; }
    public function getMessage(): string { return $this->message; }
    public function getStyleClassname(): string { return $this->styleClassname; }

    /**
     * @param int $style
     * @return $this
     */
    public function setStyle(int $style): self {

        if (array_key_exists($style, $this->styles)) {
            $this->style = $style;
            $this->styleClassname = $this->styles[$style];
        } else {
            $this->style = 0; // Default index for 'primary'
            $this->styleClassname = 'primary';
        }

        return $this;
    }

    public function setMessage(string $message): self {
        $this->message = $message;
        return $this;
    }

}
