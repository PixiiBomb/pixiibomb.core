<?php

namespace PixiiBomb\Core\Http\Controllers;

use PixiiBomb\Core\Support\PixiiBomb;

class WelcomeController extends PageController
{
    public function welcome()
    {
        $page = app(PixiiBomb::class)->getDefaultPage();

        return parent::view($page, [
            'packages' => PixiiBomb::getInstalledPackages(),
        ]);
    }
}
