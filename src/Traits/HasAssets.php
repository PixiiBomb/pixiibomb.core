<?php

namespace PixiiBomb\Core\Traits;

use PixiiBomb\Core\Support\PixiiAssetManager;

/**
 * Provides Vite stylesheet and script entry-point support.
 *
 * Logical asset names are resolved through PixiiAssetManager. Unqualified
 * assets resolve beneath the Laravel application's resources directory, while
 * namespaced assets resolve beneath registered package resource directories.
 *
 * Examples:
 *
 * - blocks/application-welcome
 * - pixii::blocks/ui-welcome
 */
trait HasAssets
{
    /**
     * Application-root-relative Vite stylesheet entry points attached to the
     * object.
     *
     * @var list<string>
     */
    protected array $stylesheets = [];

    /**
     * Application-root-relative Vite script entry points attached to the
     * object.
     *
     * @var list<string>
     */
    protected array $scripts = [];

    /**
     * Gets the attached Vite stylesheet entry points.
     *
     * @return list<string>
     */
    public function getStylesheets(): array
    {
        return $this->stylesheets;
    }

    /**
     * Gets the attached Vite script entry points.
     *
     * @return list<string>
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * Attaches one or more stylesheets.
     *
     * The `resources/css` directory and `.css` extension are supplied
     * automatically. Package assets may be referenced using a registered
     * namespace.
     *
     * Minified assets must be requested explicitly by including `.min` in the
     * logical asset name.
     *
     * Examples:
     *
     * - blocks/application-welcome
     * - blocks/application-welcome.min
     * - pixii::blocks/ui-welcome
     *
     * @param list<string> $stylesheets The logical stylesheet names to attach.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function setStylesheets(array $stylesheets = []): static
    {
        $resolvedStylesheets = app(PixiiAssetManager::class)
            ->resolveStylesheets($stylesheets);

        $this->stylesheets = array_values(array_unique([
            ...$this->stylesheets,
            ...$resolvedStylesheets,
        ]));

        return $this;
    }

    /**
     * Attaches one or more scripts.
     *
     * The `resources/js` directory and `.js` extension are supplied
     * automatically. Package assets may be referenced using a registered
     * namespace.
     *
     * Minified assets must be requested explicitly by including `.min` in the
     * logical asset name.
     *
     * Examples:
     *
     * - blocks/application-welcome
     * - blocks/application-welcome.min
     * - pixii::blocks/ui-welcome
     *
     * @param list<string> $scripts The logical script names to attach.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function setScripts(array $scripts = []): static
    {
        $resolvedScripts = app(PixiiAssetManager::class)
            ->resolveScripts($scripts);

        $this->scripts = array_values(array_unique([
            ...$this->scripts,
            ...$resolvedScripts,
        ]));

        return $this;
    }

    /**
     * Removes all attached stylesheets.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function clearStylesheets(): static
    {
        $this->stylesheets = [];

        return $this;
    }

    /**
     * Removes all attached scripts.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function clearScripts(): static
    {
        $this->scripts = [];

        return $this;
    }
}
