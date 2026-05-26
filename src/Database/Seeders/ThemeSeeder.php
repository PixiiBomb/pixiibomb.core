<?php

namespace PixiiBomb\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use PixiiBomb\Core\Models\Theme;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $themesPath = public_path('css/themes');

        if (! File::exists($themesPath)) {
            return;
        }

        foreach (File::directories($themesPath) as $themeDirectory) {
            $folder = basename($themeDirectory);
            $palettes = $this->getPaletteNames($themeDirectory);

            Theme::query()->updateOrCreate(
                [
                    'folder_name' => $folder,
                ],
                [
                    'display_name' => $this->formatDisplayName($folder),
                    'description' => $this->getDescription($folder),
                    'thumbnail_path' => "images/thumbnails/themes/$folder.png",
                    'default_palette' => $palettes[0] ?? null,
                    'palettes' => $palettes,
                    'is_active' => true,
                    'is_default' => $folder === 'pixii',
                ]
            );
        }
    }

    protected function getPaletteNames(string $themeDirectory): array
    {
        $directory = "$themeDirectory/palettes";

        if (! File::exists($directory)) {
            return [];
        }

        return collect(File::files($directory))
            ->filter(fn ($file) => $file->getExtension() === 'css')
            ->map(fn ($file) => pathinfo($file->getFilename(), PATHINFO_FILENAME))
            ->sort()
            ->values()
            ->all();
    }

    protected function formatDisplayName(string $folderName): string
    {
        return str($folderName)
            ->replace(['-', '_'], ' ')
            ->title()
            ->toString();
    }

    protected function getDescription(string $folderName): string
    {
        return match ($folderName) {
            'pixii' => 'Soft watercolor storybook theme with fairy journal, cottagecore, and magical pastel styling.',
            'base' => 'Clean default theme for standard light and dark application layouts.',
            'hologlass' => 'A futuristic glassmorphism theme featuring holographic gradients, translucent surfaces, neon glow effects, and sleek sci-fi inspired UI styling.',
            'manuscript' => 'Elegant manuscript-inspired theme with tactile paper textures, rich ink contrast, and handcrafted editorial styling.',
            default => 'Custom PixiiBomb theme.',
        };
    }
}
