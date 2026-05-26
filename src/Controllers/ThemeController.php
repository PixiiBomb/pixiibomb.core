<?php

namespace PixiiBomb\Core\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Models\Theme;
use PixiiBomb\Core\Models\UserSetting;

class ThemeController extends PageController
{
    public function index(): View
    {
        $themes = Theme::query()
            ->where('is_active', true)
            ->get();

        $tabs = ['Accordions', 'Alerts', 'Badges', 'Breadcrumbs', 'Buttons', 'Cards', 'Carousels', 'Forms', 'Lists', 'Menu', 'Modals', 'Navbar', 'Off-Canvas', 'Pagination', 'Progress', 'Spinners', 'Tables', 'Tabs', 'Toasts', 'Tooltips'];

        $page = new Page(parent::me())
            ->setStylesheets(['blocks/theme/index']);

        return parent::view($page)->with([
            'themes' => $themes,
            'tabs' => $tabs,
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'theme_id' => ['required', 'integer', 'exists:themes,id'],
            'palette' => ['required', 'string', 'max:255'],
        ]);

        $theme = Theme::query()->findOrFail($data['theme_id']);

        abort_unless(
            in_array($data['palette'], $theme->palettes ?? [], true),
            422,
            'The selected palette is not available for this theme.'
        );

        UserSetting::query()->updateOrCreate(
            [
                'user_id' => auth()->id(),
            ],
            [
                'theme_id' => $theme->id,
                'palette' => $data['palette'],
            ]
        );

        return back();
    }

    public function buttons(): View
    {
        $page = new Page(parent::me());

        return parent::view($page);
    }
}
