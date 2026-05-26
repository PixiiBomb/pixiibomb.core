<?php

namespace PixiiBomb\Core\Blocks;

use InvalidArgumentException;
use PixiiBomb\Core\Data\{Block, ComponentBlock, Section};
use PixiiBomb\Core\Enums\CardStyle;
use PixiiBomb\Core\Traits\HasStyle;

class Card extends ComponentBlock
{
    use HasStyle;

    protected Block|Section|string|array|null $header = null;
    protected Block|Section|string|array|null $body = null;
    protected Block|Section|string|array|null $footer = null;
    protected string|null $title = null;
    protected string|null $subtitle = null;
    protected string|null $thumbnail = null;

    protected static function getStyleEnum(): string
    {
        return CardStyle::class;
    }

    public function getHeader(): Block|Section|string|array|null
    {
        return $this->header;
    }

    public function getBody(): Block|Section|string|array|null
    {
        return $this->body;
    }

    public function getFooter(): Block|Section|string|array|null
    {
        return $this->footer;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getSubtitle(): string|null
    {
        return $this->subtitle;
    }

    public function getThumbnail(): string|null
    {
        return $this->thumbnail;
    }

    public function setHeader(Block|Section|string|array|null $header): self
    {
        $this->header = $this->validateContent($header);
        return $this;
    }

    public function setBody(Block|Section|string|array|null $body): self
    {
        $this->body = $this->validateContent($body);
        return $this;
    }

    public function setFooter(Block|Section|string|array|null $footer): self
    {
        $this->footer = $this->validateContent($footer);
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    protected function validateContent(Block|Section|string|array|null $content): Block|Section|string|array|null
    {
        if (is_string($content) && str_starts_with($content, self::YIELD_INDICATOR)) {
            return new Section(
                substr($content, strlen(self::YIELD_INDICATOR))
            );
        }

        if (!is_array($content)) {
            return $content;
        }

        foreach ($content as $item) {
            if (!$item instanceof Block) {
                throw new InvalidArgumentException('Card content arrays may only contain Block instances.');
            }
        }

        return $content;
    }
}
