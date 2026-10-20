@use(PixiiBomb\Ui\Blocks\Alert)
@use(PixiiBomb\Ui\Blocks\Icon)
@use(PixiiBomb\Ui\Enums\BootstrapIconSet)

@php
    $alert = new Alert('what it do')
        ->setTitle('hello')
        ->setIcon(BootstrapIconSet::ACTIVITY);
    $icon = new Icon(BootstrapIconSet::HEART);
@endphp

@block($alert)
@block($icon)
