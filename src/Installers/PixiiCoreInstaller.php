<?php

namespace PixiiBomb\Core\Installers;

use Illuminate\Console\Command;
use PixiiBomb\Core\Attributes\Installer;
use PixiiBomb\Core\Attributes\InstallerDetails;

#[InstallerDetails('pixiibomb/core', priority: 0, icon: "📦")]
class PixiiCoreInstaller extends PixiiBombInstaller
{
    #[Installer(
        isRequired: true,
        description: "Publishes `PixiiBomb` vendor files"
    )]
    public function vendorPublish(Command $command): void
    {
        $this->callArtisan($command, 'vendor:publish', [
            '--provider' => 'PixiiBomb\Core\PixiiBombCoreServiceProvider',
            '--tag' => 'core.publish.config',
        ]);
    }
}
