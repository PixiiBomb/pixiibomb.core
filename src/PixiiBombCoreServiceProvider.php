<?php

namespace PixiiBomb\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use PixiiBomb\Core\Console\Commands\PixiiInstallCommand;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Exceptions\RequiredVariableNotFoundException;
use PixiiBomb\Core\Installers\PixiiCoreInstaller;
use PixiiBomb\Core\Layouts\CoreLayout;
use PixiiBomb\Core\Support\{PixiiAssetManager, PixiiBomb, PixiiLog, PixiiUtilities};
use PixiiBomb\Core\Templates\CoreTemplate;

class PixiiBombCoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(PixiiBomb::class, 'pixii');

        $this->app->singleton(PixiiBomb::class, fn () => new PixiiBomb());
        $this->app->singleton(PixiiLog::class, fn () => new PixiiLog());
        $this->app->singleton(PixiiAssetManager::class, fn () => new PixiiAssetManager());
        $this->app->singleton(PixiiUtilities::class, fn () => new PixiiUtilities());
    }

    public function boot(PixiiAssetManager $assets): void
    {
        $assets->registerNamespace('pixii', 'vendor/pixiibomb/core/resources');

        $this->publishes([
            $this->getPackagePath('publish/config/') => config_path(),
        ], 'pixii-core-config');

        /* $this->mergeConfigFrom(
            __DIR__ . '/../publish/config/pixii.core.php',
            'pixii'
        ); */

        $this->loadViewsFrom(
            $this->getPackagePath('resources/views'),
            'pixii'
        );

        $this->loadRoutesFrom(
            $this->getPackagePath('routes/web.php')
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                PixiiInstallCommand::class,
            ]);
        }

        $this->registerDirectives();

        $this->configureApp();
    }

    private function configureApp(): void {
        $pixii = app(PixiiBomb::class);

        $pixii->setDefaultTemplate(new CoreTemplate());
        $pixii->setDefaultLayout(new CoreLayout());
        $pixii->registerDefaultPage(new Page('pixii::core-welcome'));
        $pixii->registerInstaller(PixiiCoreInstaller::class);
    }

    private function registerDirectives(): void
    {
        Blade::componentNamespace('PixiiBomb\\Core\\View\\Components', 'pixii');

        Blade::if('debug', function() {
            return config('app.debug');
        });

        Blade::directive('block', function ($expression) {
            $key = 'block';
            return "<?php echo view({$expression}->getView(), array_merge(get_defined_vars(), ['{$key}' => {$expression}]))->render(); ?>";
        });

        Blade::directive('require', function (string $expression): string {
            $expression = trim($expression);
            $expression = trim($expression, '()');

            if (!preg_match(
                '/^\$([A-Za-z_][A-Za-z0-9_]*)$/',
                $expression,
                $matches,
            )) {
                throw new InvalidArgumentException(
                    'The @require directive expects one variable. ' .
                    'Example: @require($block).'
                );
            }

            $variableName = $matches[1];
            $exception = '\\' . RequiredVariableNotFoundException::class;

            return <<<PHP
                <?php
                    if (!isset({$expression})) {
                        throw new {$exception}('{$variableName}');
                    }
                ?>
                PHP;
        });
    }

    private function getPackagePath(string $path): string
    {
        return __DIR__.'/../'.$path;
    }
}
