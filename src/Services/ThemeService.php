<?php

namespace PixiiBomb\Core\Services;

use PixiiBomb\Core\Models\Theme;
use PixiiBomb\Core\Models\UserSetting;

class ThemeService
{
    const string STYLESHEETS_DIRECTORIES = 'css/themes';
    const string STYLESHEETS_FOLDER = 'structures';
    const string PALETTES_FOLDER = 'palettes';

    public function getActiveTheme(?UserSetting $user_settings = null): ?Theme
    {
        return $user_settings?->theme
            ?? Theme::query()->where('is_default', true)->first()
            ?? Theme::query()->where('folder_name', 'base')->first();
    }

    public function getActivePalette(?Theme $theme, ?UserSetting $user_settings = null): string
    {
        return $user_settings?->palette
            ?? $theme?->default_palette
            ?? 'parchment';
    }

    public function getActivePalettePath(?Theme $theme, string $palette): string
    {
        $directory = self::STYLESHEETS_DIRECTORIES;
        $folder = self::PALETTES_FOLDER;
        $theme_folder = $theme?->folder_name ?? 'base';

        return "$directory/$theme_folder/$folder/$palette.css";
    }

    public function getActiveStylesheetPaths(?Theme $theme): array
    {
        $directory = self::STYLESHEETS_DIRECTORIES;
        $folder = self::STYLESHEETS_FOLDER;
        $theme_folder = $theme?->folder_name ?? 'base';

        return glob("$directory/$theme_folder/$folder/*.css");
    }

    public function getActiveThemeData(?UserSetting $user_settings = null): array
    {
        $theme = $this->getActiveTheme($user_settings);
        $palette = $this->getActivePalette($theme, $user_settings);

        return [
            'active' => $theme,
            'palette' => $palette,
            'palette_path' => $this->getActivePalettePath($theme, $palette),
            'stylesheets' => $this->getActiveStylesheetPaths($theme),
        ];
    }
}
