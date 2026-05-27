<?php

namespace PixiiBomb\Core\Blocks;

use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Core\Enums\GenericStyle;

class ComponentPreview extends ComponentBlock
{
    private const string DEFAULT_TITLE = 'Component Preview';
    private const string DEFAULT_DESCRIPTION = 'A preview of a component';

    protected string $title = self::DEFAULT_TITLE;
    protected string $description = self::DEFAULT_DESCRIPTION;
    protected array $sections = [];

    public function __construct(array $sections = [], string $title = self::DEFAULT_TITLE, string $description = self::DEFAULT_DESCRIPTION)
    {
        parent::__construct();
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setSections($sections);
    }

    protected static function getStyleEnum(): string
    {
        return GenericStyle::class;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setSections(array $sections): self
    {
        $this->sections = $sections;
        return $this;
    }
}
