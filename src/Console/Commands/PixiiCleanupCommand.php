<?php

namespace PixiiBomb\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

/**
 * Remove PixiiBomb-generated backup files from the host Laravel project.
 *
 * Deletes:
 *  - *.bak files throughout the project
 *  - root-level hidden backups such as .env.bak
 */
class PixiiCleanupCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'pixii:cleanup';

    /**
     * The console command description.
     */
    protected $description = 'Remove PixiiBomb .bak backup files from the project.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $deleted = $this->removeRootBackupFiles();

        $finder = Finder::create()
            ->files()
            ->ignoreDotFiles(false)
            ->in(base_path())
            ->name('*.bak');

        foreach ($finder as $file) {
            $path = $file->getPathname();

            File::delete($path);

            $deleted[] = $path;
        }

        $this->newLine();

        if (count($deleted) === 0) {
            $this->info('No .bak files found.');

            return self::SUCCESS;
        }

        $this->info('🧹 PixiiBomb cleanup complete.');
        $this->newLine();

        $this->line('Deleted:');

        foreach ($deleted as $path) {
            $relative = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $path);

            $this->line("• {$relative}");
        }

        $this->newLine();
        $this->info('Total deleted: ' . count($deleted));

        return self::SUCCESS;
    }

    /**
     * Remove backup files located in the project root.
     *
     * Symfony Finder does not reliably include root-level hidden files
     * such as ".env.bak", so these files are cleaned up separately.
     *
     * @return array<string> List of deleted absolute file paths.
     */
    private function removeRootBackupFiles(): array
    {
        $deleted = [];

        $rootFiles = [
            base_path('.env.bak'),
        ];

        foreach (glob(base_path('.env.*.bak')) as $file) {
            $rootFiles[] = $file;
        }

        foreach ($rootFiles as $path) {
            if (! File::exists($path)) {
                continue;
            }

            File::delete($path);

            $deleted[] = $path;
        }

        return $deleted;
    }
}
