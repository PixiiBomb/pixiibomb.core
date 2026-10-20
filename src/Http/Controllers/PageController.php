<?php

namespace PixiiBomb\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\Page;

/**
 * Base controller for PixiiBomb page rendering.
 *
 * Provides:
 *  - Standardized Page object rendering
 *  - Automatic layout/template resolution
 *  - Route/Controller metadata injection
 *  - Conventional block view resolution
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
     * @param Page|null $page The Page object to render.
     * @param mixed $data Additional custom view data.
     * @return View
     */
    protected function view(?Page $page, mixed $data = []): View
    {
        $id = $this->getPageId();
        $layout = $page?->getLayout();

        $parameters = array_merge(
            [
                'id' => $id,
                //'route' => $route,
                //'route_signature' => $routeSignature,
                'controller' => $this,
                'page' => $page,
                'stylesheets' => $this->getStylesheets($page?->getBlocks()),
                'scripts' => $this->getScripts($page?->getBlocks()),
            ],
            $data
        );

        return view($layout->getView())->with($parameters);
    }

    protected function getPageId(): string
    {
        $route = Route::getCurrentRoute();
        $routeSignature = $route->action['controller'];
        $lastPart = substr(strrchr($routeSignature, '\\'), 1);
        $replace = str_replace(['Controller', '@'], ['', '-'], $lastPart);

        return Str::kebab($replace);
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

    /**
     * Collect the stylesheet paths attached to the supplied blocks.
     *
     * Duplicate, empty, and invalid stylesheet entries are removed while
     * preserving the order in which the blocks declared their assets.
     *
     * @param array<int, Block> $blocks
     * @return array<int, string>
     */
    protected function getStylesheets(array $blocks): array
    {
        return $this->getBlockAssets(
            $blocks,
            fn (Block $block): array => $block->getStylesheets()
        );
    }

    /**
     * Collect the script paths attached to the supplied blocks.
     *
     * Duplicate, empty, and invalid script entries are removed while
     * preserving the order in which the blocks declared their assets.
     *
     * @param array<int, Block> $blocks
     * @return array<int, string>
     */
    protected function getScripts(array $blocks): array
    {
        return $this->getBlockAssets(
            $blocks,
            fn (Block $block): array => $block->getScripts()
        );
    }

    /**
     * Collect and normalize an asset type from the supplied blocks.
     *
     * @param array<int, Block> $blocks
     * @param Closure $assetResolver
     * @return array<int, string>
     */
    private function getBlockAssets(array $blocks, Closure $assetResolver): array
    {
        return collect($blocks)
            ->filter(fn (mixed $block): bool => $block instanceof Block)
            ->flatMap($assetResolver)
            ->filter(
                fn (mixed $asset): bool => is_string($asset) &&
                    trim($asset) !== ''
            )
            ->map(fn (string $asset): string => trim($asset))
            ->unique()
            ->values()
            ->all();
    }
}
