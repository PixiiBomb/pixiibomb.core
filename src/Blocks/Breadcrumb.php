<?php

namespace PixiiBomb\Core\Blocks;

use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Core\Data\MenuItem;
use PixiiBomb\Core\Enums\BreadcrumbStyle;

class Breadcrumb extends ComponentBlock
{
    protected array $items = [];

    protected static function getStyleEnum(): string
    {
        return BreadcrumbStyle::class;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;

        $this->items = collect($items)
            ->filter(fn($item) => $item instanceof MenuItem)
            ->values()
            ->all();
        return $this;
    }
}
