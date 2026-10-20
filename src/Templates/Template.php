<?php

namespace PixiiBomb\Core\Templates;

use PixiiBomb\Core\Traits\HasView;

class Template
{
    use HasView {
        HasView::setView as protected setBaseView;
    }

    const string DIRECTORY = 'templates';
    protected ?string $defaultView;

    public function setView(string $view): static
    {
        $directory = self::DIRECTORY;

        return $this->setBaseView("$directory.$view");
    }
}
