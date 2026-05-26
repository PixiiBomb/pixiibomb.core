@php
    /** @var $page */
    if (! isset($page)) {
        dd("Unable to display templates.app.blade.php - the Page object is not set. Please refer to documentation for additional information");
    }

    $meta = $page->getMeta();
    $blocks = $page->getBlocks();
    $scripts = $page->getScripts();
    $stylesheets = $page->getStylesheets();
    $theme_folder = $theme['active'] ?? null;
    $active_theme_palette_path = $theme['palette_path'] ?? null;
    $active_theme_stylesheets = $theme['stylesheets'] ?? [];
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(file_exists(public_path($active_theme_palette_path)))
        <link id="theme-palette" rel="stylesheet" href="{{ asset($active_theme_palette_path) }}">
    @endif

    @php $i=0; @endphp
    @foreach($active_theme_stylesheets as $stylesheet)
        @if(file_exists(public_path($stylesheet)))
            <link id="theme-{{ $i }}" rel="stylesheet" href="{{ asset($stylesheet) }}">
            @php $i++; @endphp
        @endif
    @endforeach

    @isset($stylesheets)
        @foreach($stylesheets as $stylesheet)
            <link rel="stylesheet" href="{{ asset($stylesheet) }}">
        @endforeach
    @endisset

    @isset($scripts)
        @foreach($scripts as $script)
            <script src="{{ asset($script) }}?v={{ filemtime(public_path($script)) }}" defer></script>
        @endforeach
    @endisset
</head>

<body id="{{ $id }}">

<main id="{{ $page->formatLayoutId() }}">
    @yield('layout')
</main>

</body>

@include('includes.footer')
</html>
