<?php

namespace PixiiBomb\Core\Layouts;

use PixiiBomb\Core\Traits\HasAlias;
use PixiiBomb\Core\Traits\HasAssets;
use PixiiBomb\Core\Traits\HasView;

class Layout
{
    use HasAlias;
    use HasView {
        HasView::setView as protected setBaseView;
    }
    use HasAssets;

    const string DIRECTORY = 'layouts';

    protected ?string $defaultView = null;

    public function __construct()
    {
        $this->setAlias(basename(get_class($this)));
    }

    public function setView(string $view): static
    {
        $directory = self::DIRECTORY;
        return $this->setBaseView("$directory.$view");
    }
}
