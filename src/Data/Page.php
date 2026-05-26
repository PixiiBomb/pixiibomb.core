<?php

namespace PixiiBomb\Core\Data;

use Illuminate\Support\Str;

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
    /**
     * The base Blade template name.
     */
    protected ?string $template = 'app';

    /**
     * The base Blade layout name.
     */
    protected ?string $layout = 'vertical';

    /**
     * The blocks rendered inside the page layout.
     *
     * @var array<string, Block>
     */
    protected array $blocks = [];

    /**
     * Public stylesheet names attached to this page.
     *
     * @var array<int, string>
     */
    protected array $stylesheets = [];

    /**
     * Public script paths attached to this page.
     *
     * @var array<int, string>
     */
    protected array $scripts = [];

    /**
     * Create a new Page object.
     *
     * @param string|null $view Optional block view shorthand.
     * @param Meta|null $meta Optional page metadata.
     */
    public function __construct(?string $view = null, protected ?Meta $meta = new Meta(null))
    {
        $this->setMeta($meta);
        $this->setTemplate($this->template);
        $this->setLayout($this->layout);

        if ($view !== null) {
            $this->setView($view);
        }
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
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * Get the fully-qualified Blade layout path.
     */
    public function getLayout(): ?string
    {
        return $this->layout;
    }

    /**
     * Get attached public script paths.
     *
     * @return array<int, string>
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * Get attached public stylesheet names.
     *
     * @return array<int, string>
     */
    public function getStylesheets(): array
    {
        return $this->stylesheets;
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
    protected function setView(string $view): void
    {
        $this->setBlocks([
            new Block()->setView($view),
        ]);
    }

    /**
     * Set the blocks rendered by this page.
     *
     * Non-Block values are ignored.
     *
     * @param array<int|string, mixed> $blocks Candidate block values.
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
     *
     * Example:
     *  - app => templates.app
     */
    public function setTemplate(?string $template): self
    {
        $this->template = "templates.{$template}";

        return $this;
    }

    /**
     * Set the page layout.
     *
     * Example:
     *  - Vertical => "layouts.vertical"
     */
    public function setLayout(?string $layout): self
    {
        $this->layout = "layouts.{$layout}";

        return $this;
    }

    /**
     * Attach public JavaScript files to this page.
     *
     * Scripts are resolved from public/js and may reference either:
     *  - js/name.min.js
     *  - js/name.js
     *
     * @param array<int, string> $scripts Script names without the .js extension.
     */
    public function setScripts(array $scripts = []): self
    {
        foreach ($scripts as $script) {
            $relativePath = $this->getScriptRelativePath($script);

            if (! is_null($relativePath) && ! in_array($relativePath, $this->scripts, true)) {
                $this->scripts[] = $relativePath;
            }
        }

        return $this;
    }

    /**
     * Attach public CSS files to this page.
     *
     * Stylesheets are resolved from public/css/name.css.
     *
     * @param array<int, string> $stylesheets Stylesheet names without the .css extension.
     */
    public function setStylesheets(array $stylesheets = []): self
    {
        foreach ($stylesheets as $stylesheet) {
            $relativePath = $this->getStylesheetRelativePath($stylesheet);

            if (! is_null($relativePath) && ! in_array($relativePath, $this->stylesheets, true)) {
                $this->stylesheets[] = $relativePath;
            }
        }

        return $this;
    }

    /**
     * Format the configured layout name into a DOM-safe layout id.
     */
    public function formatLayoutId(): string
    {
        $replace = str_replace('layouts.', '', $this->layout);
        $id = "layout-$replace";

        return Str::kebab($id);
    }

    /**
     * Resolve a public JavaScript file path by script name.
     */
    protected function getScriptRelativePath($script): ?string
    {
        $minifiedFilename = "js/$script.min.js";
        $normalFilename = "js/$script.js";

        $minifiedPath = public_path($minifiedFilename);
        $normalPath = public_path($normalFilename);

        if (file_exists($minifiedPath)) {
            return $minifiedFilename;
        }

        if (file_exists($normalPath)) {
            return $normalFilename;
        }

        logger()->warning("Script '$script' not found in public/js/ as either .min.js or .js.");

        return null;
    }

    /**
     * Resolve a public CSS file path by stylesheet name.
     */
    protected function getStylesheetRelativePath($stylesheet): ?string
    {
        $filename = "css/$stylesheet.css";
        $path = public_path($filename);

        if (file_exists($path)) {
            return $filename;
        }

        logger()->warning("Stylesheet '$stylesheet' not found in public/css/ as .css.");

        return null;
    }
}
