<?php

namespace PixiiBomb\Core\Traits;

trait HasView
{
    /** ------------------------------------------------------------------------------------------ @region PROPERTIES */
    protected ?string $view = null;

    protected ?string $requestedView = null {
        set {
            $this->requestedView = $value;
        }
    }

    protected bool $viewExists = false;

    /** --------------------------------------------------------------------------------------------- @region GETTERS */
    public function getView(): ?string { return $this->view; }
    public function getRequestedView(): ?string { return $this->requestedView; }

    /** --------------------------------------------------------------------------------------------- @region SETTERS */
    public function setView(?string $view): self {
        $this->requestedView = $view;
        $this->viewExists = view()->exists($view);
        $this->view = $this->viewExists
            ? $view
            : 'errors.404';

        return $this;
    }

    /** --------------------------------------------------------------------------------------------- @region HELPERS */
    public function viewExists(): bool { return $this->viewExists; }
}
