<?php

namespace PixiiBomb\Core\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PixiiBomb\Core\Controllers\PageController;
use PixiiBomb\Core\Data\Meta;
use PixiiBomb\Core\Data\Page;

/**
 * Handle authenticated user dashboard blocks.
 *
 * Provides:
 *  - dashboard page rendering
 *  - authenticated user landing experience
 *  - dashboard-specific stylesheets
 */
class DashboardController extends PageController
{
    /**
     * Display the authenticated user dashboard.
     */
    public function index(): View
    {
        $page = new Page('blocks.user.dashboard', new Meta('Dashboard'));
        $page->setStylesheets(['dashboard']);

        return parent::view($page);
    }

    /**
     * Update the authenticated user's avatar.
     */
    public function patchAvatar(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        $file = $data['avatar'];

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images/avatars'), $filename);

        $request->user()->update([
            'avatar' => $filename,
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Avatar updated.');
    }
}
