@php
    $meta = $page->getMeta();
    $blocks = $page->getBlocks();
    $layout = $page->getLayout();
    //$scripts = $page->getScripts();
    //$scripts = array_merge($layout->getScripts());
    //$stylesheets = $page->getStylesheets();
    //$stylesheets = array_merge($layout->getStylesheets());
    //$theme_folder = $theme['active'] ?? null;
    //$active_theme_palette_path = $theme['palette_path'] ?? null;
    //$active_theme_stylesheets = $theme['stylesheets'] ?? [];
@endphp

<!doctype html>
<html lang="">
<head>
    <title>{{ isset($meta) ? $meta->getTitle() : config('app.name') }}</title>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @isset($meta)
        <meta name="description" content="{{ $meta->getDescription() }}">
        <meta name="keywords" content="{{ $meta->getKeywords() }}">
        <meta name="author" content="{{ $meta->getAuthor() }}">
    @endisset

    @if (Illuminate\Support\Facades\Vite::manifestHash())
        @vite(['resources/css/app.css', 'resources/js/pixii-ui.js'])
    @endif

</head>

<body id="{{ $id }}" data-layout="{{ $layout->getAlias() }}">

<main>
    @yield('layout')
</main>

</body>

</html>
