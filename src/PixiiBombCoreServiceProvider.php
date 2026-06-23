<?php

namespace PixiiBomb\Core;

use App\Models\User;
use Illuminate\Support\Facades\{Blade, Gate};
use Illuminate\Support\ServiceProvider;
use PixiiBomb\Core\Console\Commands\{PixiiCleanupCommand, PixiiInstallCommand, PixiiControllerCommand};
use PixiiBomb\Core\Models\{Role, Theme};
use PixiiBomb\Core\Policies\{RolePolicy, ThemePolicy, UserPolicy};
use PixiiBomb\Core\Enums\Strings;

/**
 * Core service provider for the PixiiBomb framework.
 *
 * Responsible for registering Blade directives, publishing vendor assets, and wiring PixiiBomb console commands.
 */
class PixiiBombCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerDirectives();
        $this->registerVendorFiles();
        $this->registerCommands();
        $this->registerPolicies();
    }

    /**
     * Registers custom Blade conditional directives.
     *
     * Currently, provides:
     *  - @ debug ... @ enddebug<br />
     *  Renders content only when the application is in debug mode.
     */
    private function registerDirectives(): void
    {
        Blade::componentNamespace('PixiiBomb\\Core\\View\\Components', Strings::PIXII->value);

        Blade::if(Strings::DEBUG->value, function() {
            return config('app.debug');
        });

        Blade::directive(Strings::BLOCK->value, function ($expression) {
            $key = Strings::BLOCK->value;

            return "<?php echo view({$expression}->getView(), array_merge(get_defined_vars(), ['{$key}' => {$expression}]))->render(); ?>";
        });
    }

    /**
     * Registers publishable vendor assets:
     * - php artisan vendor:publish --provider="PixiiBomb\Core\PixiiBombCoreServiceProvider"
     *
     * Publish individual groups:
     * - php artisan vendor:publish --provider="PixiiBomb\Core\PixiiBombCoreServiceProvider" --tag=config
     * - php artisan vendor:publish --provider="PixiiBomb\Core\PixiiBombCoreServiceProvider" --tag=resources
     */
    private function registerVendorFiles(): void
    {
        $this->publishes([
            $this->fromPackage('publish/app') => app_path(),
        ], 'app');

        $this->publishes([
            $this->fromPackage('publish/config') => config_path(),
        ], 'config');

        $this->publishes([
            $this->fromPackage('publish/database') => database_path(),
        ], 'database');

        $this->publishes([
            $this->fromPackage('publish/public') => public_path(),
        ], 'public');

        $this->publishes([
            $this->fromPackage('publish/resources') => resource_path(),
        ], 'resources');

        $this->publishes([
            $this->fromPackage('publish/routes') => base_path('routes'),
        ], 'routes');

        $this->publishes([
            $this->fromPackage('publish/vite.config.js') => base_path('vite.config.js'),
        ], 'vite');
    }

    /**
     * Registers PixiiBomb Artisan commands.
     */
    private function registerCommands(): void
    {
        if (!$this->app->runningInConsole())
            return;

        $this->commands([
            PixiiInstallCommand::class,
            PixiiCleanupCommand::class,
            PixiiControllerCommand::class
        ]);
    }

    /**
     * Registers PixiiBomb authorization policies.
     */
    private function registerPolicies(): void
    {
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Theme::class, ThemePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }

    /**
     * Resolves an absolute path relative to the package root.
     */
    private function fromPackage(string $path): string
    {
        return __DIR__.'/../'.$path;
    }
}
