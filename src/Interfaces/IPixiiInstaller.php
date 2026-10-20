<?php

namespace PixiiBomb\Core\Interfaces;

interface IPixiiInstaller
{
    public function getPackageName(): string;

    public function getInstallerPriority(): int;

    public function getInstallSteps(): array;
}
