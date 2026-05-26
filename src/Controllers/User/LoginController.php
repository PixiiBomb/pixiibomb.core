<?php

namespace PixiiBomb\Core\Controllers\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PixiiBomb\Core\Controllers\PageController;
use PixiiBomb\Core\Data\Meta;
use PixiiBomb\Core\Data\Page;

/**
 * Handle frontend login blocks and session-based authentication.
 *
 * Provides:
 *  - login page rendering
 *  - credential validation
 *  - Laravel session authentication
 *  - redirecting authenticated users to the dashboard
 */
class LoginController extends PageController
{
    /**
     * Display the login page.
     */
    public function index(): View
    {
        $page = new Page('blocks.auth.login', new Meta('Login'));
        $page->setStylesheets(['login']);

        return parent::view($page);
    }

    /**
     * Authenticate the user using Laravel session authentication.
     *
     * On successful authentication:
     *  - the session is regenerated
     *  - the user is redirected to the dashboard
     *
     * On failure:
     *  - validation errors are returned to the login page
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/dashboard');
    }
}
