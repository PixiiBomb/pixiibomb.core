<?php

namespace PixiiBomb\Core\Data;

use PixiiBomb\Core\Layouts\CoreLayout;
use PixiiBomb\Core\Layouts\Layout;
use PixiiBomb\Core\Support\PixiiBomb;
use PixiiBomb\Core\Templates\CoreTemplate;
use PixiiBomb\Core\Templates\Template;

/**
 * Represents a PixiiBomb page definition.
 *
 * The Page object describes how a page should be assembled:
 *  - which template should wrap the page
 *  - which layout should render the page
 *  - which blocks should be included
 *  - which metadata should be rendered
 *  - which public scripts and stylesheets should be attached
 */
class Page
{
    protected ?Meta $meta = null;

    /**
     * The base Blade template name.
     */
    protected ?Template $template = null;

    /**
     * The base Blade layout name.
     */
    protected ?Layout $layout = null;

    /**
     * The blocks rendered inside the page layout.
     *
     * @var array<string, Block>
     */
    protected array $blocks = [];

    /**
     * Create a new Page object.
     *
     * @param string|null $view Optional block view shorthand.
     * @param Meta|null $meta Optional page metadata.
     */
    public function __construct(?string $view = null, ?Meta $meta = new Meta(null))
    {
        $this->setMeta($meta);
        $this->setTemplate(null);
        $this->setLayout(null);
        $this->setView($view);
    }

    /**
     * Get the page metadata.
     */
    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    /**
     * Get the page blocks.
     *
     * @return array<string, Block>
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * Get the fully qualified Blade template path.
     */
    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    /**
     * Get the layout object.
     */
    public function getLayout(): ?Layout
    {
        return $this->layout;
    }

    /**
     * Set the page metadata.
     */
    public function setMeta(?Meta $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Set the page blocks using a single block view shorthand.
     */
    protected function setView(?string $view): self
    {
        if ($view == null) {
            return $this;
        }

        $this->setBlocks([
            new Block()->setView($view),
        ]);

        return $this;
    }

    /**
     * Set the blocks rendered by this page.
     *
     * Non-Block values are ignored.
     *
     * @param array $blocks Candidate block values.
     */
    public function setBlocks(array $blocks): self
    {
        $this->blocks = collect($blocks)
            ->filter(fn ($block) => $block instanceof Block)
            ->values()
            ->all();

        return $this;
    }

    /**
     * Set the page template.
     */
    public function setTemplate(?Template $template): self
    {
        $defaultTemplate = app(PixiiBomb::class)->getDefaultTemplate() ?? CoreTemplate::class;

        $this->template = $template ?? $defaultTemplate;

        return $this;
    }

    /**
     * Set the page layout.
     */
    public function setLayout(?Layout $layout): self
    {
        $defaultLayout = app(PixiiBomb::class)->getDefaultLayout() ?? CoreLayout::class;

        $this->layout = $layout ?? $defaultLayout;
        return $this;
    }
}
