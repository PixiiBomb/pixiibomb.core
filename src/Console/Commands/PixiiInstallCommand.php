<?php

namespace PixiiBomb\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\{Artisan, File};

/**
 * PixiiBomb installation command.
 *
 * ---------------------------------------------------------------------------------------------
 * INSTALL FOOTPRINT
 * ---------------------------------------------------------------------------------------------
 * This command modifies, creates, publishes, or deletes the following host Laravel files.
 *
 * BACKED UP BEFORE MODIFICATION (.bak)
 * ---------------------------------------------------------------------------------------------
 * app/Models/User.php
 * bootstrap/app.php
 * routes/web.php
 * routes/api.php
 * vite.config.js
 * .env
 * config/sanctum.php
 * resources/css/app.css
 * resources/js/app.js
 * resources/views/welcome.blade.php
 *
 * PUBLISHED FROM PACKAGE
 * ---------------------------------------------------------------------------------------------
 * app/*
 * config/*
 * resources/*
 * routes/*
 * public/*
 * vite.config.js
 *
 * CREATED / OVERWRITTEN
 * ---------------------------------------------------------------------------------------------
 * app/Http/Controllers/HomeController.php
 * app/Models/User.php
 * database/seeders/DatabaseSeeder.php
 *
 * DELETED
 * ---------------------------------------------------------------------------------------------
 * resources/views/welcome.blade.php
 *
 * MODIFIED
 * ---------------------------------------------------------------------------------------------
 * package.json
 * .env
 *
 * INSTALLED VIA ARTISAN
 * ---------------------------------------------------------------------------------------------
 * php artisan install:api --force
 *
 * NPM DEPENDENCIES ADDED
 * ---------------------------------------------------------------------------------------------
 * bootstrap
 * @popperjs/core
 *
 * NPM DEPENDENCIES REMOVED
 * ---------------------------------------------------------------------------------------------
 * tailwindcss
 * @tailwindcss/vite
 *
 * MANUAL UNINSTALL
 * ---------------------------------------------------------------------------------------------
 * 1) composer remove pixiibomb/core
 * 2) restore any desired .bak files
 * 3) manually delete published PixiiBomb files
 * 4) npm uninstall bootstrap @popperjs/core
 * 5) reinstall tailwind if desired
 */
class PixiiInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'pixii:install
                            {--preserve : Do not overwrite existing Laravel files}
                            {--app-name=PixiiBomb : Application name for APP_NAME}
                            {--db-name= : MySQL database name}
                            {--db-user=pixii : MySQL username}
                            {--db-password=nothing : MySQL password}
                            {--db-host=127.0.0.1 : MySQL host}
                            {--db-port=3306 : MySQL port}';

    /**
     * The console command description.
     */
    protected $description = 'Install PixiiBomb Core files, update frontend dependencies, and configure the local environment.';

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): int
    {
        $preserve = (bool) $this->option('preserve');

        $appName = (string) $this->option('app-name');
        $databaseName = (string) ($this->option('db-name') ?: $this->defaultDatabaseName());
        $databaseUser = (string) $this->option('db-user');
        $databasePassword = (string) $this->option('db-password');
        $databaseHost = (string) $this->option('db-host');
        $databasePort = (string) $this->option('db-port');

        // 0) Create backups before publishing PixiiBomb files.
        // $backupsCreated = $this->backupInstallFiles();

        // 1) Publish PixiiBomb files into the host Laravel application.
        $exitCode = Artisan::call('vendor:publish', [
            '--provider' => 'PixiiBomb\Core\PixiiBombCoreServiceProvider',
            '--force' => ! $preserve,
        ]);

        if ($exitCode !== 0) {
            $this->error('Laravel failed to publish PixiiBomb/Core vendor files.');
            $this->line(Artisan::output());

            return self::FAILURE;
        }

        // 2) Update the host Laravel project package.json.
        $packageJsonUpdated = $this->updateNpmDependencies();
        $apiInstalled = $this->installApiScaffolding();

        // 3) Delete the Laravel welcome page after backup.
        $welcomeDeleted = $this->deleteWelcomeBlade();

        // 4) Create the HomeController if it does not exist, or overwrite it when not preserving.
        $homeControllerCreated = $this->createHomeController($preserve);

        // 5) Update the host Laravel project .env file.
        $envUpdated = $this->updateEnvFile(
            $appName,
            $databaseName,
            $databaseUser,
            $databasePassword,
            $databaseHost,
            $databasePort
        );
        $configCleared = $envUpdated;

        // 6) Create the DatabaseSeeder if it does not exist, or overwrite it when not preserving.
        $databaseSeederCreated = $this->createDatabaseSeeder();

        // 7) Update User Model
        $userModelCreated = $this->createUserModel($preserve);

        $this->newLine();
        $this->info('✅ PixiiBomb install complete.');
        $this->line('Changes:');
        // $this->line('• Backups: ' . ($backupsCreated ? 'created' : 'no files found to backup'));
        $this->line('• Vendor publish: done');
        $this->line('• package.json deps: ' . ($packageJsonUpdated ? 'updated' : 'already satisfied'));
        $this->line('• API scaffolding: ' . ($apiInstalled ? 'installed' : 'already installed'));
        $this->line('• Welcome page: ' . ($welcomeDeleted ? 'deleted' : 'not found'));
        $this->line('• HomeController: ' . ($homeControllerCreated ? 'created/updated' : 'already exists'));
        $this->line('• .env: ' . ($envUpdated ? 'updated' : 'not updated'));
        $this->line('• Config cache: ' . ($configCleared ? 'cleared' : 'not cleared'));
        $this->line('• DatabaseSeeder: ' . ($databaseSeederCreated ? 'created/updated' : 'not updated'));
        $this->line('• User model: ' . ($userModelCreated ? 'created/updated' : 'already exists'));

        $this->newLine();
        $this->warn('1) Manually update files:');
        $this->line('👉  Add AI API keys to .env');
        $this->newLine();
        $this->printDatabaseSetupInstructions($databaseName, $databaseUser, $databasePassword);
        $this->newLine();
        $this->warn('3) Initialize the database and run:');
        $this->line('👉 npm install');
        $this->line('👉 php artisan migrate');
        $this->line('👉 php artisan db:seed');
        $this->line('👉 php artisan serve');
        $this->line('👉 npm run dev');
        $this->newLine();
        $this->warn('4) Optional composer updates');
        $this->line('👉 composer require laravel/ai');

        return self::SUCCESS;
    }

    /**
     * Create backups for Laravel files that PixiiBomb may replace or remove.
     *
     * @return bool True if at least one backup was created.
     */
    private function backupInstallFiles(): bool
    {
        $backedUp = false;

        foreach ($this->installBackupPaths() as $path) {
            if ($this->backupFile($path)) {
                $backedUp = true;
            }
        }

        return $backedUp;
    }

    /**
     * Gets the host Laravel files that PixiiBomb should back up before installation.
     *
     * @return array<int, string>
     */
    private function installBackupPaths(): array
    {
        return [
            app_path('Models/User.php'),
            base_path('bootstrap/app.php'),
            base_path('routes/web.php'),
            base_path('routes/api.php'),
            base_path('vite.config.js'),
            base_path('.env'),
            config_path('sanctum.php'),
            resource_path('css/app.css'),
            resource_path('js/app.js'),
            resource_path('views/welcome.blade.php'),
        ];
    }

    /**
     * Update the host Laravel project's package.json dependencies.
     *
     * Adds Bootstrap dependencies and removes Tailwind dependencies because PixiiBomb
     * owns the published app.css/app.js files for this personal-project starter.
     *
     * @return bool True if package.json was modified, false if already satisfied.
     *
     * @throws FileNotFoundException
     */
    private function updateNpmDependencies(): bool
    {
        $path = base_path('package.json');

        if (! File::exists($path)) {
            $this->warn('package.json not found. Skipping NPM dependency update.');

            return false;
        }

        $raw = File::get($path);
        $json = json_decode($raw, true);

        if (! is_array($json)) {
            $this->error('package.json is not valid JSON. Skipping dependency update.');

            return false;
        }

        $changed = false;

        $dependencies = $json['dependencies'] ?? [];
        if (! is_array($dependencies)) {
            $dependencies = [];
        }

        foreach ($this->npmDependenciesToAdd() as $package => $version) {
            if (($dependencies[$package] ?? null) !== $version) {
                $dependencies[$package] = $version;
                $changed = true;
            }
        }

        foreach ($this->npmPackagesToRemove() as $package) {
            if (array_key_exists($package, $dependencies)) {
                unset($dependencies[$package]);
                $changed = true;
            }
        }

        ksort($dependencies);
        $json['dependencies'] = $dependencies;

        $devDependencies = $json['devDependencies'] ?? [];
        if (is_array($devDependencies)) {
            foreach ($this->npmPackagesToRemove() as $package) {
                if (array_key_exists($package, $devDependencies)) {
                    unset($devDependencies[$package]);
                    $changed = true;
                }
            }

            ksort($devDependencies);
            $json['devDependencies'] = $devDependencies;
        }

        if (! $changed) {
            return false;
        }

        $this->backupFile($path);

        File::put($path, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);

        return true;
    }

    /**
     * Gets NPM dependencies PixiiBomb requires in the host Laravel project.
     *
     * @return array<string, string>
     */
    private function npmDependenciesToAdd(): array
    {
        return [
            '@popperjs/core' => '^2.11.8',
            'bootstrap' => '^5.3.8',
            'bootstrap-icons' => '^1.13.1',
        ];
    }

    /**
     * Gets NPM packages PixiiBomb removes from the host Laravel project.
     *
     * @return array<int, string>
     */
    private function npmPackagesToRemove(): array
    {
        return [
            '@tailwindcss/vite',
            'tailwindcss',
        ];
    }

    /**
     * Delete resources/views/welcome.blade.php.
     *
     * The file is backed up before vendor publishing, so this only removes the active copy.
     */
    private function deleteWelcomeBlade(): bool
    {
        $path = resource_path('views/welcome.blade.php');

        if (! File::exists($path)) {
            return false;
        }

        File::delete($path);

        return true;
    }

    /**
     * Create the host app HomeController using the PixiiBomb controller generator.
     *
     * @return bool True if the controller was generated.
     */
    private function createHomeController(bool $preserve): bool
    {
        $path = app_path('Http/Controllers/HomeController.php');

        if ($preserve && File::exists($path)) {
            return false;
        }

        Artisan::call('pixii:controller', [
            'name' => 'HomeController',
        ]);

        return true;
    }

    /**
     * Update the host Laravel project's .env file with PixiiBomb defaults.
     *
     * @throws FileNotFoundException
     */
    private function updateEnvFile(string $appName, string $databaseName, string $databaseUser, string $databasePassword, string $databaseHost, string $databasePort): bool
    {
        $path = base_path('.env');

        if (! File::exists($path)) {
            $this->warn('.env not found. Skipping environment update.');

            return false;
        }

        $contents = File::get($path);

        $replacements = [
            'APP_NAME' => $this->quoteEnvValue($appName),
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => $databaseHost,
            'DB_PORT' => $databasePort,
            'DB_DATABASE' => $databaseName,
            'DB_USERNAME' => $databaseUser,
            'DB_PASSWORD' => $databasePassword,
        ];

        foreach ($replacements as $key => $value) {
            $contents = $this->setEnvValue($contents, $key, $value);
        }

        $contents = $this->ensureAiEnvSection($contents);
        $contents = $this->normalizeEnvSpacing($contents);

        File::put($path, $contents);

        Artisan::call('config:clear');

        return true;
    }

    /**
     * Set an environment value, uncommenting the line if Laravel generated it commented out.
     */
    private function setEnvValue(string $contents, string $key, string $value): string
    {
        $pattern = '/^#?\s*' . preg_quote($key, '/') . '=.*$/m';
        $line = $key . '=' . $value;

        if (preg_match($pattern, $contents)) {
            return preg_replace($pattern, $line, $contents, 1);
        }

        return rtrim($contents) . PHP_EOL . $line . PHP_EOL;
    }

    /**
     * Ensure PixiiBomb AI environment keys exist.
     *
     * Existing values are preserved.
     */
    private function ensureAiEnvSection(string $contents): string
    {
        $aiDefaults = [
            'OPENAI_API_KEY' => '',
            'OPENAI_DEV_MODEL' => 'gpt-5.5-mini',
            'OPENAI_PROD_MODEL' => 'gpt-5.5',
        ];

        $missing = array_filter($aiDefaults, function ($key) use ($contents) {
            return !$this->envKeyExists($contents, $key);
        }, ARRAY_FILTER_USE_KEY);

        if (empty($missing)) {
            return $contents;
        }

        $section = PHP_EOL . '# AI' . PHP_EOL;

        foreach ($missing as $key => $value) {
            $section .= $key . '=' . $value . PHP_EOL;
        }

        return rtrim($contents) . PHP_EOL . $section;
    }

    /**
     * Determine whether an environment key already exists, even if commented out.
     */
    private function envKeyExists(string $contents, string $key): bool
    {
        $pattern = '/^#?\s*' . preg_quote($key, '/') . '=.*$/m';

        return preg_match($pattern, $contents) === 1;
    }

    /**
     * Keep the database section visually separated from the logging section.
     */
    private function normalizeEnvSpacing(string $contents): string
    {
        $contents = preg_replace("/LOG_LEVEL=([^\r\n]+)\RDB_CONNECTION=/", "LOG_LEVEL=$1" . PHP_EOL . PHP_EOL . "DB_CONNECTION=", $contents);
        return preg_replace("/DB_PASSWORD=([^\r\n]+)\RSESSION_DRIVER=/", "DB_PASSWORD=$1" . PHP_EOL . PHP_EOL . "SESSION_DRIVER=", $contents);
    }

    /**
     * Quote environment values that contain whitespace.
     */
    private function quoteEnvValue(string $value): string
    {
        if ($value === '') {
            return '""';
        }

        if (preg_match('/\s/', $value)) {
            return '"' . str_replace('"', '\"', $value) . '"';
        }

        return $value;
    }

    /**
     * Print the manual SQL needed to create the local MySQL database and user.
     */
    private function printDatabaseSetupInstructions(string $databaseName, string $databaseUser, string $databasePassword): void
    {
        $this->warn('2) Database setup SQL:');
        $this->line('👉 Open WSL and create the database using the SQL below.');
        $this->line("\tsudo mysql");
        $this->line("\tCREATE DATABASE IF NOT EXISTS `{$databaseName}`;");
        $this->line("\tCREATE USER IF NOT EXISTS '{$databaseUser}'@'localhost' IDENTIFIED BY '{$databasePassword}';");
        $this->line("\tGRANT ALL PRIVILEGES ON `{$databaseName}`.* TO '{$databaseUser}'@'localhost';");
        $this->line("\tFLUSH PRIVILEGES;");
    }

    /**
     * Generate the default MySQL database name from the Laravel project folder.
     *
     * Example:
     *  pixiibomb.core -> pixiibomb_core_db
     */
    private function defaultDatabaseName(): string
    {
        return str_replace(['.', '-'], '_', basename(base_path())) . '_db';
    }

    /**
     * Create a backup file next to the original file.
     *
     * @return bool True if a backup was created.
     */
    private function backupFile(string $path): bool
    {
        if (! File::exists($path)) {
            return false;
        }

        $backup = $path . '.bak';

        if (File::exists($backup)) {
            $backup = $path . '.' . date('Ymd_His') . '.bak';
        }

        File::copy($path, $backup);

        return true;
    }

    /**
     * Install Laravel API scaffolding and Sanctum configuration.
     *
     * Skips installation when routes/api.php and config/sanctum.php
     * already exist in the host application.
     *
     * @return bool True if API scaffolding was installed.
     */
    private function installApiScaffolding(): bool
    {
        if (File::exists(base_path('routes/api.php')) && File::exists(config_path('sanctum.php'))) {
            return false;
        }

        $exitCode = Artisan::call('install:api', [
            '--force' => true,
        ]);

        if ($exitCode !== 0) {
            $this->error('Laravel API scaffolding failed.');
            $this->line(Artisan::output());

            return false;
        }

        return true;
    }

    /**
     * Create the host Laravel DatabaseSeeder using the PixiiBomb template.
     *
     * @return bool True if the DatabaseSeeder was created or updated.
     */
    private function createDatabaseSeeder(): bool
    {
        $path = database_path('seeders/DatabaseSeeder.php');
        $template = __DIR__ . '/../../Templates/DatabaseSeeder.php.tmpl';

        if (! File::exists($template)) {
            $this->warn('DatabaseSeeder template not found.');

            return false;
        }

        File::put($path, File::get($template));

        return true;
    }

    /**
     * Create the host Laravel User model using the PixiiBomb template.
     *
     * @param bool $preserve When true, existing User.php will not be overwritten.
     * @return bool True if the User model was created or updated.
     * @throws FileNotFoundException
     */
    private function createUserModel(bool $preserve): bool
    {
        $path = app_path('Models/User.php');

        if ($preserve && File::exists($path)) {
            return false;
        }

        $template = __DIR__ . '/../../Templates/User.php.tmpl';

        if (! File::exists($template)) {
            $this->warn('User model template not found.');

            return false;
        }

        File::put($path, File::get($template));

        return true;
    }
}
