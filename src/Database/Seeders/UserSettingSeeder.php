<?php

namespace PixiiBomb\Core\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use PixiiBomb\Core\Models\Theme;
use PixiiBomb\Core\Models\UserSetting;

class UserSettingSeeder extends Seeder
{
    public function run(): void
    {
        $theme = Theme::query()
            ->where('is_default', true)
            ->first()
            ?? Theme::query()->where('folder_name', 'base')->first();

        $palette = $theme?->default_palette ?? 'parchment';

        User::query()->each(function (User $user) use ($theme, $palette): void {
            UserSetting::query()->updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'theme_id' => $theme?->id,
                    'palette' => $palette,
                ]
            );
        });
    }
}
