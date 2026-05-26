<?php

namespace PixiiBomb\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Models\Theme;
use PixiiBomb\Core\Services\ThemeService;

/**
 * Base controller for PixiiBomb page rendering.
 *
 * Provides:
 *  - standardized Page object rendering
 *  - automatic layout/template resolution
 *  - route/controller metadata injection
 *  - conventional block view resolution
 *
 * Controllers extending PageController typically return a Page object
 * and allow PixiiBomb to assemble the final rendered layout.
 */
class PageController extends Controller
{
    /**
     * Render a PixiiBomb Page object using the configured layout.
     *
     * Injects common rendering parameters into the view:
     *  - Route
     *  - Route signature
     *  - Controller instance
     *  - Page object
     *  - Generated page id
     *
     * @param Page $page The Page object to render.
     * @param mixed $data Additional custom view data.
     */
    protected function view(Page $page, mixed $data = []): View
    {
        $route = Route::getCurrentRoute();
        $routeSignature = $route->action['controller'];

        $layout = $page->getLayout();

        if (! view()->exists($layout)) {
            $requestedTemplate = "Couldn't find requested '\$page->getLayout()': '$layout'";
            $controller = "Route Signature: $routeSignature";
            $me = $this->me();

            dump(
                $requestedTemplate,
                $controller,
                $page,
                "Attempting to display view: '$me'"
            );

            abort(404);
        }

        $lastPart = substr(strrchr($routeSignature, '\\'), 1);
        $replace = str_replace(['Controller', '@'], ['', '-'], $lastPart);
        $id = Str::kebab($replace);
        $user = auth()->user();
        $user_settings = $user?->settings;

        $parameters = array_merge(
            [
                'id' => $id,
                'route' => $route,
                'route_signature' => $routeSignature,
                'controller' => $this,
                'page' => $page,
                'user' => $user,
                'user_settings' => $user_settings,
                'theme' => app(ThemeService::class)->getActiveThemeData($user_settings),
            ],
            $data
        );

        return view($layout)->with($parameters);
    }

    /**
     * Resolve the conventional block view for the current controller action.
     *
     * Example:
     *  - TestController@index => blocks.test.index
     *  - UserProfileController@edit => blocks.user-profile.edit
     */
    protected function me(): string
    {
        // Controller short name without namespace: "TestController"
        $controller = class_basename($this);

        // Strip the conventional suffix
        $controller = Str::replaceLast('Controller', '', $controller);

        // Normalize controller + method into view segments
        $controllerSegment = Str::kebab($controller);

        // Route action method: "index"
        $route = Route::current();
        $method = $route?->getActionMethod();

        // Fallback if route isn't a controller action
        if (! is_string($method) || $method === '') {
            $method = 'index';
        }

        $methodSegment = Str::kebab($method);

        return "blocks.{$controllerSegment}.{$methodSegment}";
    }
}
