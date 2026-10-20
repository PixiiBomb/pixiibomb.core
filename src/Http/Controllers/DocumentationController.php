<?php

namespace PixiiBomb\Core\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\MenuGroup;
use PixiiBomb\Core\Data\MenuItem;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Ui\Blocks\Sidebar;
use PixiiBomb\Ui\Layouts\DocsLayout;

class DocumentationController extends PageController
{
    public function index(string $package = 'core', string $path = 'index'): View
    {
        $view = "pixii::docs.{$package}.{$path}";
        $viewExists = view()->exists($view);

        if (!$viewExists) {
            abort(404);
        }

        $blocks = [
            new Block()->setView($view)
        ];

        $page = new Page()
            ->setLayout(new DocsLayout())
            ->setBlocks($blocks);

        $groups =
            [
                new MenuGroup('Getting Started', [
                    new MenuItem($package, "/docs/{$package}/index")
                ]),
                $this->createMenuGroup($package, 'Traits'),
            ];

        return parent::view($page)
            ->with([
                'sidebar' => new Sidebar()->setMenuGroups($groups),
                'route' => request()->path()
            ]);
    }

    protected function createMenuGroup(string $package, string $folder, bool $formatFilename = false): MenuGroup
    {
        $packageRoot = dirname(__DIR__, 4);
        $packageDirectory = "{$packageRoot}/{$package}";

        try {
            $files = File::allFiles("{$packageDirectory}/src/{$folder}");
        }
        catch (\Exception $e) {
            // @TODO SOME LOG ERROR?
            abort(404);
        }

        $items = [];

        foreach($files as $file)
        {
            $filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);

            if($formatFilename)
            {
                $filename = Str::headline($filename);
            }

            $kebabFile = Str::kebab($filename);
            $kebabPackage = Str::kebab($package);
            $kebabFolder = Str::kebab($folder);
            $item = new MenuItem($filename, strtolower("/docs/{$kebabPackage}/{$kebabFolder}/{$kebabFile}"));

            $items[] = $item;
        }

        return new MenuGroup($folder, $items);
    }
}
