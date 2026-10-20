<?php

namespace PixiiBomb\Core\Installers;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use PixiiBomb\Core\Attributes\Installer;
use PixiiBomb\Core\Attributes\InstallerDetails;
use PixiiBomb\Core\Interfaces\IPixiiInstaller;
use PixiiBomb\Core\Support\PixiiLog;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class PixiiBombInstaller implements IPixiiInstaller
{
    protected PixiiLog $log;

    public function setLog(PixiiLog $log): static
    {
        $this->log = $log;

        return $this;
    }

    public function getPackageName(): string
    {
        return $this->getInstallerAttribute()->package;
    }

    public function getInstallerPriority(): int
    {
        return $this->getInstallerAttribute()->priority;
    }

    public function getIcon(): ?string
    {
        return $this->getInstallerAttribute()->icon;
    }

    public function getInstallSteps(): array
    {
        $reflection = new ReflectionClass($this);

        $steps = [];

        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $attributes = $method->getAttributes(Installer::class);

            if (empty($attributes)) {
                continue;
            }

            $attribute = $attributes[0]->newInstance();

            if (! $attribute instanceof Installer) {
                continue;
            }

            $steps[] = [
                'method' => $method->getName(),
                'description' => $attribute->description,
                'isRequired' => $attribute->isRequired,
                'line' => $method->getStartLine(),
            ];
        }

        usort($steps, fn (array $a, array $b) => $a['line'] <=> $b['line']);

        return $steps;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $attributeClass
     * @return T
     * @throws ReflectionException
     */
    protected function getClassAttribute(string $targetClass, string $attributeClass): object {
        $reflection = new ReflectionClass($targetClass);

        $attributes = $reflection->getAttributes($attributeClass);

        if (empty($attributes)) {
            throw new RuntimeException("{$targetClass} is missing {$attributeClass}.");
        }

        $attribute = $attributes[0]->newInstance();

        if (! $attribute instanceof $attributeClass) {
            throw new RuntimeException("{$targetClass} has an invalid {$attributeClass}.");
        }

        return $attribute;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $attributeClass
     * @return T
     * @throws ReflectionException
     */
    protected function getMethodAttribute(string $targetClass, string $method, string $attributeClass): object {
        $reflection = new ReflectionMethod($targetClass, $method);

        $attributes = $reflection->getAttributes($attributeClass);

        if (empty($attributes)) {
            throw new RuntimeException("{$targetClass}::{$method} is missing {$attributeClass}.");
        }

        $attribute = $attributes[0]->newInstance();

        if (! $attribute instanceof $attributeClass) {
            throw new RuntimeException("{$targetClass}::{$method} has an invalid {$attributeClass}.");
        }

        return $attribute;
    }

    /**
     * @throws ReflectionException
     */
    protected function getFillableAttribute(): Fillable
    {
        /** @var Fillable */
        return $this->getClassAttribute(User::class, Fillable::class);
    }

    /**
     * @throws ReflectionException
     */
    protected function getInstallerAttribute(): InstallerDetails
    {
        /** @var InstallerDetails */
        return $this->getClassAttribute(static::class, InstallerDetails::class);
    }

    protected function injectTraitIntoUserModel(Command $command, string $traitClass): void
    {
        $userModelPath = 'app/Models/User.php';
        $path = base_path($userModelPath);

        if (! file_exists($path)) {
            $this->log->error("User model not found at [{$userModelPath}].");
            return;
        }

        $traitName = class_basename($traitClass);
        $contents = file_get_contents($path);

        if ($contents === false) {
            $this->log->error("Unable to read [{$userModelPath}].");
            return;
        }

        if (str_contains($contents, $traitClass) || str_contains($contents, "use {$traitName};")) {
            $this->log->info("{$traitName} is already installed on the User model.");
            return;
        }

        $contents = $this->injectUseStatement($contents, $traitClass);
        $contents = $this->injectTraitUsage($contents, $traitName);

        file_put_contents($path, $contents);

        $this->log->success("Injected {$traitName} into App\\Models\\User.");
    }

    protected function injectFillableProperties(array $properties): void
    {
        $path = app_path('Models/User.php');

        if (! file_exists($path)) {
            $this->log->error('User model not found.');
            return;
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            $this->log->error('Unable to read User model.');
            return;
        }

        $pattern = '/#\[Fillable\(\[(.*?)\]\)\]/s';

        if (! preg_match($pattern, $contents, $matches)) {
            $this->log->warning('Fillable attribute not found.');
            return;
        }

        $existing = collect(explode(',', $matches[1]))
            ->map(fn ($value) => trim($value))
            ->filter()
            ->map(fn ($value) => trim($value, "'\""))
            ->values();

        $fillable = $existing
            ->merge($properties)
            ->unique()
            ->sort()
            ->values();

        $replacement = '#[Fillable(['.
            $fillable
                ->map(fn ($value) => "'{$value}'")
                ->implode(', ').
            '])]';

        $contents = preg_replace(
            $pattern,
            $replacement,
            $contents,
            1
        ) ?? $contents;

        file_put_contents($path, $contents);

        $this->log->success('Updated Fillable attribute.');
    }

    protected function injectUseStatement(string $contents, string $traitClass): string
    {
        $useStatement = "use {$traitClass};";

        if (str_contains($contents, $useStatement)) {
            return $contents;
        }

        return preg_replace(
            '/namespace App\\\\Models;\s*/',
            "namespace App\\Models;\n\n{$useStatement}\n",
            $contents,
            1
        ) ?? $contents;
    }

    protected function injectTraitUsage(string $contents, string $traitName): string
    {
        return preg_replace_callback(
            '/class\s+\w+\s+extends\s+[^{]+\{\s*(.*?)use\s+([^;]+);/s',
            function ($matches) use ($traitName) {
                $traits = collect(explode(',', $matches[2]))
                    ->map(fn ($trait) => trim($trait))
                    ->push($traitName)
                    ->unique()
                    ->implode(', ');

                return str_replace(
                    "use {$matches[2]};",
                    "use {$traits};",
                    $matches[0]
                );
            },
            $contents,
            1
        ) ?? $contents;
    }

    protected function defaultDatabaseName(): string
    {
        return str_replace(['.', '-'], '_', basename(base_path())).'_db';
    }

    protected function updateEnvFile(Command $command, string $appName, string $databaseName, string $databaseUser, string $databasePassword, string $databaseHost, string $databasePort): void {
        $path = base_path('.env');

        if (! file_exists($path)) {
            $this->log->warning('.env not found. Skipping environment update.');
            return;
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            $this->log->error('Unable to read .env file.');
            return;
        }

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

        file_put_contents($path, $contents);

        $this->callArtisan($command, 'config:clear');

        $this->log->success('.env updated.');
    }

    protected function setEnvValue(string $contents, string $key, string $value): string
    {
        $pattern = '/^#?\s*'.preg_quote($key, '/').'=.*$/m';
        $line = "{$key}={$value}";

        if (preg_match($pattern, $contents)) {
            return preg_replace($pattern, $line, $contents, 1) ?? $contents;
        }

        return rtrim($contents).PHP_EOL.$line.PHP_EOL;
    }

    protected function quoteEnvValue(string $value): string
    {
        if ($value === '') {
            return '""';
        }

        if (preg_match('/\s/', $value)) {
            return '"'.str_replace('"', '\"', $value).'"';
        }

        return $value;
    }

    protected function getEnvValue(string $key): ?string
    {
        $path = base_path('.env');

        if (! file_exists($path)) {
            return null;
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            return null;
        }

        $pattern = '/^#?\s*'.preg_quote($key, '/').'=(.*)$/m';

        if (! preg_match($pattern, $contents, $matches)) {
            return null;
        }

        return trim($matches[1]);
    }

    protected function getDatabaseEnvValues(): array
    {
        return [
            'DB_CONNECTION' => $this->getEnvValue('DB_CONNECTION') ?? '',
            'DB_HOST' => $this->getEnvValue('DB_HOST') ?? '',
            'DB_PORT' => $this->getEnvValue('DB_PORT') ?? '',
            'DB_DATABASE' => $this->getEnvValue('DB_DATABASE') ?? '',
            'DB_USERNAME' => $this->getEnvValue('DB_USERNAME') ?? '',
            'DB_PASSWORD' => $this->getEnvValue('DB_PASSWORD') ?? '',
        ];
    }

    protected function normalizeEnvSpacing(string $contents): string
    {
        $contents = preg_replace(
            "/LOG_LEVEL=([^\r\n]+)\RDB_CONNECTION=/",
            "LOG_LEVEL=$1".PHP_EOL.PHP_EOL."DB_CONNECTION=",
            $contents
        ) ?? $contents;

        $contents = preg_replace(
            "/DB_PASSWORD=([^\r\n]*)\RSESSION_DRIVER=/",
            "DB_PASSWORD=$1".PHP_EOL.PHP_EOL."SESSION_DRIVER=",
            $contents
        ) ?? $contents;

        return $contents;
    }

    protected function updateDatabaseEnvFile(
        Command $command,
        string $databaseConnection,
        string $databaseName,
        string $databaseUser,
        string $databasePassword,
        string $databaseHost,
        string $databasePort,
    ): void {
        $path = base_path('.env');

        if (! file_exists($path)) {
            $this->log->warning('.env not found. Skipping environment update.');
            return;
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            $this->log->error('Unable to read .env file.');
            return;
        }

        $replacements = [
            'DB_CONNECTION' => $databaseConnection,
            'DB_HOST' => $databaseHost,
            'DB_PORT' => $databasePort,
            'DB_DATABASE' => $databaseName,
            'DB_USERNAME' => $databaseUser,
            'DB_PASSWORD' => $databasePassword,
        ];

        foreach ($replacements as $key => $value) {
            $contents = $this->setEnvValue($contents, $key, $value);
        }

        $contents = $this->normalizeEnvSpacing($contents);

        file_put_contents($path, $contents);

        $this->callArtisan($command, 'config:clear');

        $this->log->success('.env database values updated.');
    }

    protected function callArtisan(Command $command, string $name, array $arguments = []): bool {
        $exitCode = $command->call($name, $arguments);
        return $exitCode === SymfonyCommand::SUCCESS;
    }

    protected function injectSeedersIntoDatabaseSeeder(array $seederClasses): void
    {
        $path = database_path('seeders/DatabaseSeeder.php');

        if (! file_exists($path)) {
            $this->log->error('DatabaseSeeder.php not found.');
            return;
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            $this->log->error('Unable to read DatabaseSeeder.php.');
            return;
        }

        foreach ($seederClasses as $seederClass) {
            $contents = $this->injectUseStatementForClass($contents, $seederClass);
        }

        $contents = $this->injectSeederCalls($contents, $seederClasses);

        file_put_contents($path, $contents);

        $this->log->success('PixiiBomb seeders registered in DatabaseSeeder.php.');
    }

    protected function injectUseStatementForClass(string $contents, string $class): string
    {
        $useStatement = "use {$class};";

        if (str_contains($contents, $useStatement)) {
            return $contents;
        }

        return preg_replace(
            '/namespace Database\\\\Seeders;\s*/',
            "namespace Database\\Seeders;\n\n{$useStatement}\n",
            $contents,
            1
        ) ?? $contents;
    }

    protected function injectSeederCalls(string $contents, array $seederClasses): string
    {
        $shortNames = collect($seederClasses)
            ->map(fn (string $class) => class_basename($class))
            ->unique()
            ->values();

        $calls = $shortNames
            ->map(fn (string $name) => "            {$name}::class,")
            ->implode(PHP_EOL);

        if ($shortNames->every(fn (string $name) => str_contains($contents, "{$name}::class"))) {
            return $contents;
        }

        if (preg_match('/\$this->call\(\s*\[(.*?)\]\s*\);/s', $contents)) {
            return preg_replace_callback(
                '/\$this->call\(\s*\[(.*?)\]\s*\);/s',
                function ($matches) use ($shortNames) {
                    $existing = $matches[1];

                    $newLines = $shortNames
                        ->reject(fn (string $name) => str_contains($existing, "{$name}::class"))
                        ->map(fn (string $name) => "            {$name}::class,")
                        ->implode(PHP_EOL);

                    if ($newLines === '') {
                        return $matches[0];
                    }

                    return "\$this->call([".PHP_EOL
                        .rtrim($existing).PHP_EOL
                        .$newLines.PHP_EOL
                        .'        ]);';
                },
                $contents,
                1
            ) ?? $contents;
        }

        return preg_replace(
            '/public function run\(\): void\s*\{\s*/',
            "public function run(): void\n    {\n        \$this->call([\n{$calls}\n        ]);\n\n",
            $contents,
            1
        ) ?? $contents;
    }

    protected function hasMigration(string $migrationName): bool
    {
        return collect(glob(database_path("migrations/*_{$migrationName}.php")))
            ->isNotEmpty();
    }

    protected function confirm(Command $command, string $question, bool $default = true): bool {
        return $command->confirm($question, $default);
    }

    protected function ask(Command $command, string $question, ?string $default = null): string {
        return (string) $command->ask($question, $default);
    }

    protected function secret(Command $command, string $question): string
    {
        return (string) ($command->secret($question) ?? '');
    }
}
