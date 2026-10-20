<?php

namespace PixiiBomb\Core\Traits;

/**
 * Provides view resolution support for a component.
 *
 * This trait tracks both the requested view and the resolved view that will be
 * rendered. If the requested view does not exist, the component automatically
 * falls back to the standard 404-error view.
 */
trait HasView
{
    /**
     * The resolved view that will be rendered.
     */
    protected ?string $view = null;

    /**
     * The view originally requested by the component.
     */
    protected ?string $requestedView = null {
        set {
            $this->requestedView = $value;
        }
    }

    /**
     * Indicates whether the requested view exists.
     */
    protected bool $viewExists = false;

    /**
     * Gets the resolved view.
     *
     * @return string|null The resolved view name.
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * Gets the originally requested view.
     *
     * @return string|null The requested view name.
     */
    public function getRequestedView(): ?string
    {
        return $this->requestedView;
    }

    /**
     * Sets the view to be rendered.
     *
     * If the requested view cannot be found, the component falls back to the
     * standard 404-error view.
     *
     * @param string|null $view The requested view name.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function setView(?string $view): static
    {
        $this->requestedView = $view;

        if ($view !== null && view()->exists($view)) {
            $this->viewExists = true;
            $this->view = $view;

            return $this;
        }

        $packageView = $view !== null && ! str_contains($view, '::')
            ? "pixii::$view"
            : $view;

        $this->viewExists = $packageView !== null && view()->exists($packageView);

        // Check Error 404
        $error404 = !view()->exists('errors.404') ?
            'pixii::errors.404' :
            'errors.404';

        $this->view = $this->viewExists
            ? $packageView
            : $error404;

        return $this;
    }

    /**
     * Determines whether the requested view exists.
     *
     * @return bool True if the requested view exists; otherwise, false.
     */
    public function viewExists(): bool
    {
        return $this->viewExists;
    }
}
