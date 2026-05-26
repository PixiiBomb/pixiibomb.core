<?php

namespace PixiiBomb\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Generate a controller using PixiiBomb conventions.
 *
 * Creates a Laravel controller extending PageController and replaces
 * the generated file using the PixiiBomb controller template.
 */
class PixiiControllerCommand extends Command
{
    /**
     * The console command signature.
     */
    protected $signature = 'pixii:controller {name : Controller name, e.g. Test or Admin/Test}
                            {--force : Overwrite the controller if it already exists}';

    /**
     * The console command description.
     */
    protected $description = 'Create a controller using PixiiBomb conventions (PageController + examples).';

    public function handle(): int
    {
        $rawName = (string) $this->argument('name');
        $force = (bool) $this->option('force');

        $normalized = $this->normalizeControllerName($rawName);

        // 1) Generate using Laravel first (ensures correct path + PSR-4 placement)
        $args = ['name' => $normalized];
        if ($force) {
            $args['--force'] = true;
        }

        $exitCode = Artisan::call('make:controller', $args);
        if ($exitCode !== 0) {
            $this->error('Laravel failed to generate the controller via make:controller.');
            $this->line(Artisan::output());
            return self::FAILURE;
        }

        // 2) Find the generated controller file
        $controllerPath = $this->resolveControllerPath($normalized);
        if (!File::exists($controllerPath)) {
            $this->error('Controller file was not found after generation.');
            $this->line("Expected: {$controllerPath}");
            $this->line(Artisan::output());
            return self::FAILURE;
        }

        // 3) Build replacement map and render template
        $templatePath = $this->templatePath('ControllerTemplate.php.tmpl');
        if (!File::exists($templatePath)) {
            $this->error('Controller template not found.');
            $this->line("Expected: {$templatePath}");
            return self::FAILURE;
        }

        $rendered = $this->renderTemplate(
            File::get($templatePath),
            $this->templateVars($normalized)
        );

        // 4) Overwrite the generated controller with our rendered template
        File::put($controllerPath, $rendered);

        $this->info('🧚 PixiiBomb controller created.');
        $this->line("• {$controllerPath}");

        return self::SUCCESS;
    }

    /**
     * Normalize input like:
     *  - "Test" => "TestController"
     *  - "Admin/Test" => "Admin\TestController"
     *  - "Admin\\Test" => "Admin\TestController"
     */
    private function normalizeControllerName(string $raw): string
    {
        $name = str_replace(['/', '\\'], '\\', $raw);
        $name = trim($name, '\\');

        if (!Str::endsWith($name, 'Controller')) {
            $name .= 'Controller';
        }

        return $name;
    }

    /**
     * Resolve the filesystem path to the controller inside the host app.
     *
     * @param string $normalizedName e.g. "Admin\TestController"
     */
    private function resolveControllerPath(string $normalizedName): string
    {
        $relative = str_replace('\\', DIRECTORY_SEPARATOR, $normalizedName) . 'UserSetting.php';
        return app_path('Http/Controllers/' . $relative);
    }

    /**
     * Get full path to a package template file.
     */
    private function templatePath(string $filename): string
    {
        // This command lives in: src/Console/Commands
        // Templates live in: src/Templates
        return __DIR__ . '/../../Templates/' . $filename;
    }

    /**
     * Build variables for the template.
     *
     * @param string $normalizedName e.g. "Admin\TestController"
     * @return array<string,string>
     */
    private function templateVars(string $normalizedName): array
    {
        $parts = explode('\\', $normalizedName);

        $className = array_pop($parts);        // "TestController"
        $subNamespace = implode('\\', $parts); // "Admin" or ""

        $namespace = 'App\\Http\\Controllers' . ($subNamespace !== '' ? '\\' . $subNamespace : '');

        $controllerAlias = Str::kebab(Str::replaceLast('Controller', '', $className));
        $blockView = "blocks.{$controllerAlias}.index"; // Example: TestController => blocks.test.index

        return [
            'namespace' => $namespace,
            'classname' => $className,
            'block_view' => $blockView,
        ];
    }

    /**
     * Render a template by replacing {{tokens}} with the provided values.
     *
     * @param string $template
     * @param array<string,string> $vars
     * @return string
     */
    private function renderTemplate(string $template, array $vars): string
    {
        // Replace all {{key}} occurrences.
        // Keep it simple for now; later you can add conditionals, loops, case transforms, etc.
        foreach ($vars as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;
    }
}
