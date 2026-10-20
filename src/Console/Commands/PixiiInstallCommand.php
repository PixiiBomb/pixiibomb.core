<?php

namespace PixiiBomb\Core\Console\Commands;

use Illuminate\Support\Collection;
use PixiiBomb\Core\Enums\ConsoleColors;
use PixiiBomb\Core\Installers\PixiiBombInstaller;
use PixiiBomb\Core\Interfaces\IPixiiInstaller;
use PixiiBomb\Core\Support\PixiiBomb;

class PixiiInstallCommand extends PixiiCommand
{
    protected $signature = 'pixii:install';

    protected $description = 'Configure all registered PixiiBomb packages.';

    public function handle(): int
    {
        $this->bootPixiiLog();

        $installers = $this->getInstallers();

        $this->log->banner();
        $this->log->primary("Detected ({$installers->count()}) PixiiBomb Packages");
        $this->displayTaskCollection($installers);

        if (!$this->confirm('Would you like to proceed?', true)) {
            $this->log->warning(
                'Installation cancelled. No changes were made. You can run pixii:install again later or complete the listed steps manually.'
            );
            return self::FAILURE;
        }

        foreach ($installers as $index => $installer) {
            if ($installer instanceof PixiiBombInstaller) {
                $installer->setLog($this->log);
            }

            $steps = collect($installer->getInstallSteps());

            $this->log->newLine();
            $this->log->primary(($index + 1) . ' of ' . $installers->count() . ' | ' . $installer->getPackageName());

            if ($steps->isEmpty()) {
                $this->log->warning('No configuration steps were registered for this package. Skipping.');
                continue;
            }

            // Required Steps
            $required = $steps->filter(fn ($step) => $step['isRequired'])->values();
            $this->runSteps($installer, $required);

            // Optional Steps
            $optional = $steps->filter(fn ($step) => ! $step['isRequired'])->values();
            if ($optional->isNotEmpty() && $this->confirm('Would you like to run optional steps?', true)) {
                $this->runSteps($installer, $optional);
            }
        }

        $this->log->success('PixiiBomb installation complete!');

        return self::SUCCESS;
    }

    private function getInstallers(): Collection
    {
        $all = app(PixiiBomb::class)->getInstallers();

        return collect($all)
            ->map(fn (string $installerClass) => app($installerClass))
            ->filter(function ($installer) {
                if (! $installer instanceof IPixiiInstaller) {
                    $this->log->warning('Skipping invalid installer ['.$installer::class.'].');
                    return false;
                }

                return true;
            })
            ->sortByDesc(fn (IPixiiInstaller $installer) => $installer->getInstallerPriority())
            ->values();
    }

    private function getInstallerTasks(Collection $installers): Collection {
        return $installers
            ->flatMap(function (IPixiiInstaller $installer) {
                return collect($installer->getInstallSteps())
                    ->map(function (array $step) use ($installer) {
                        return [
                            'package' => $installer->getPackageName(),
                            'isRequired' => $step['isRequired'],
                            'description' => $step['description'] ?? $step['method'],
                            'method' => $step['method'],
                            'installer' => $installer,
                        ];
                    });
            })
            ->values();
    }

    private function displayTaskCollection(Collection $installers): void
    {
        $this->log->newLine();
        $this->log->padded('PixiiBomb will configure your project with the following install plan:');
        $this->log->newLine();

        foreach ($installers as $installer) {
            $steps = collect($installer->getInstallSteps());

            if ($steps->isEmpty()) {
                continue;
            }

            $this->log->divider(
                title: $installer->getPackageName(),
                icon: $installer->getIcon() ?? '◆'
            );

            foreach ($steps as $step) {
                $badge = $step['isRequired']
                    ? $this->log->color('required', ConsoleColors::WARNING->value)
                    : $this->log->color('optional', ConsoleColors::INFO->value);

                $this->log->task(
                    status: $badge,
                    description: $step['description'] ?? $step['method']
                );
            }

            $this->log->newLine();
        }
    }

    private function runSteps(IPixiiInstaller $installer, Collection $steps): void
    {
        if ($steps->isEmpty()) {
            return;
        }

        foreach ($steps as $step) {
            $this->log->step($step['description'] ?? $step['method']);

            $method = $step['method'];
            $installer->{$method}($this);

            $this->log->newLine();
        }
    }
}
