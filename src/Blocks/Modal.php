<?php

namespace PixiiBomb\Core\Blocks;

use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Core\Enums\{ButtonStyle, ModalStyle};

class Modal extends ComponentBlock
{
    protected string|null $title = null;

    protected Block|string|null $body = null;

    protected array $footer = [];

    protected Button|null $buttonOpen = null;
    protected bool $hasCloseButtonInFooter = true;

    public function __construct()
    {
        parent::__construct();
        $this->setButtonOpen($this->getDefaultButtonOpen());
    }

    protected static function getStyleEnum(): string
    {
        return ModalStyle::class;
    }

    public function getButtonOpen(): Button|null
    {
        return $this->buttonOpen;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getBody(): Block|string|null
    {
        return $this->body;
    }

    public function getFooter(): array
    {
        $footer = $this->footer;

        if ($this->hasCloseButtonInFooter) {
            array_unshift($footer, $this->getDefaultCloseButton());
        }

        return $footer;
    }

    public function setButtonOpen(Button|null $buttonOpen): self
    {
        $this->buttonOpen = $buttonOpen;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setBody(Block|string|null $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setFooter(array $footer): self
    {
        $this->footer = collect($footer)
            ->filter(fn ($button) => $button instanceof Button)
            ->values()
            ->all();

        return $this;
    }

    public function setHasCloseButtonInFooter(bool $value): self
    {
        $this->hasCloseButtonInFooter = $value;

        return $this;
    }

    protected function getDefaultCloseButton(): Button
    {
        $style = ButtonStyle::SECONDARY->value;
        return new Button('Close')
            ->setStyle($style)
            ->setAttribute('data-bs-dismiss', 'modal');
    }

    protected function getDefaultButtonOpen(): Button
    {
        $style = ButtonStyle::PRIMARY->value;
        $id = $this->getId();
        return new Button('Open')
            ->setStyle($style)
            ->setAttribute('data-bs-toggle', 'modal')
            ->setAttribute('data-bs-target', "#$id");
    }
}
