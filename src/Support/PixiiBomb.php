<?php

namespace PixiiBomb\Core\Support;

use Composer\InstalledVersions;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Layouts\Layout;
use PixiiBomb\Core\Templates\Template;

class PixiiBomb
{
    protected ?Template $defaultTemplate = null;
    protected ?Layout $defaultLayout = null;
    protected ?Page $defaultPage = null;

    protected array $templates = [];
    protected array $layouts = [];
    protected array $welcomePages = [];
    protected array $installers = [];

    public function getDefaultTemplate(): ?Template
    {
        return $this->defaultTemplate;
    }

    public function getDefaultLayout(): ?Layout
    {
        return $this->defaultLayout;
    }

    public function setDefaultTemplate(Template $template, int $priority = 0): self
    {
        $this->templates[$priority] = $template;

        arsort($this->templates);

        $this->defaultTemplate = $this->templates[$priority];

        return $this;
    }

    public function setDefaultLayout(Layout $layout, int $priority = 0): self
    {
        $this->layouts[$priority] = $layout;

        arsort($this->layouts);

        $this->defaultLayout = $this->layouts[$priority];

        return $this;
    }

    public function getDefaultPage(): ?Page
    {
        return $this->defaultPage;
    }

    public function getInstallers(): array
    {
        return array_keys($this->installers);
    }

    public function registerDefaultPage(Page $page, int $priority = 0): self
    {
        $this->welcomePages[$priority] = $page;

        arsort($this->welcomePages);

        $this->defaultPage = $this->welcomePages[$priority];

        return $this;
    }

    public function registerInstaller(string $installer, int $priority = 0): self
    {
        $this->installers[$installer] = $priority;

        arsort($this->installers);

        return $this;
    }

    public static function getInstalledPackages(): \Illuminate\Support\Collection
    {
        return collect(InstalledVersions::getInstalledPackages())
            ->filter(fn ($package) => str_starts_with($package, 'pixiibomb/'))
            ->map(fn ($package) => [
                'name' => $package,
                'version' => InstalledVersions::getPrettyVersion($package) ?? 'dev',
            ])
            ->values();
    }
}
