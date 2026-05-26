@php
    if (!isset($themes) || (!isset($tabs))) {
        dd('theme and tabs information passed from the page was null', $themes, $tabs);
    }

    $active_theme = $theme['active'] ?? null;
    $active_palette = $theme['palette'] ?? $active_theme?->default_palette ?? null;

    function formatId($tab): string
    {
        return str($tab)->lower()->slug('-');
    }
@endphp

<div class="container">
    <section class="appearance-page">
        <header class="appearance-header">
            <h1>Appearance</h1>
            <p>Choose a theme and palette for PixiiBomb.</p>
        </header>

        <div class="row g-4 appearance-layout">
            <section class="col-12 col-xl-3 appearance-column">
                <div class="appearance-panel theme-picker-panel">
                    <header class="panel-header">
                        <h2>Themes</h2>
                        <p>Select a theme or palette.</p>
                    </header>

                    <div class="theme-list">
                        @foreach($themes as $available_theme)
                            @php
                                $palettes = $available_theme->palettes ?? [];
                                $default_palette = $available_theme->default_palette ?? ($palettes[0] ?? null);
                                $is_active_theme = $active_theme?->id === $available_theme->id;
                            @endphp

                            <article class="theme-card {{ $is_active_theme ? 'selected' : '' }}">
                                <form method="POST" action="{{ route('themes.settings') }}" class="theme-form">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="theme_id" value="{{ $available_theme->id }}">
                                    <input type="hidden" name="palette" value="{{ $default_palette }}">

                                    <button type="submit" class="theme-card-button">
                                        <div class="theme-preview-image">
                                            @if($available_theme->thumbnail_path)
                                                <img src="{{ asset($available_theme->thumbnail_path) }}"
                                                     alt="{{ $available_theme->display_name }} theme preview">
                                            @else
                                                <div class="theme-placeholder">
                                                    {{ strtoupper(substr($available_theme->display_name, 0, 1)) }}
                                                </div>
                                            @endif

                                            @if($is_active_theme)
                                                <span class="theme-check">✓</span>
                                            @endif
                                        </div>

                                        <div class="theme-copy">
                                            <h3>{{ $available_theme->display_name }}</h3>

                                            @if($available_theme->description)
                                                <p>{{ $available_theme->description }}</p>
                                            @endif
                                        </div>
                                    </button>
                                </form>

                                @if(! empty($palettes))
                                    <div class="palette-list">
                                        @foreach($palettes as $palette)
                                            @php
                                                $is_active_palette = $is_active_theme && $active_palette === $palette;
                                            @endphp

                                            <form method="POST" action="{{ route('themes.settings') }}"
                                                  class="palette-form">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" name="theme_id" value="{{ $available_theme->id }}">
                                                <input type="hidden" name="palette" value="{{ $palette }}">

                                                <button type="submit"
                                                        class="palette-pill {{ $is_active_palette ? 'selected' : '' }}">
                                                    {{ str($palette)->replace(['-', '_'], ' ')->title() }}
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="col-12 col-xl-7 appearance-column">
                <div class="appearance-panel component-preview-panel">
                    <header class="panel-header">
                        <h2>Component Preview</h2>
                        <p>Preview reusable Bootstrap component skins for the selected theme.</p>
                    </header>

                    <div class="tabs-scroll">
                        <ul class="nav nav-tabs preview-tabs" id="theme-preview-tabs" role="tablist">
                            @foreach($tabs as $index => $tab)
                                @php
                                    $id = formatId($tab);
                                    $active = $index === 0 ? 'active' : '';
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link {{ $active }}"
                                        id="{{ $id }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#{{ $id }}-preview"
                                        type="button"
                                        role="tab"
                                        aria-controls="{{ $id }}-preview"
                                        aria-selected="true"
                                    >
                                        {{ $tab }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content preview-content" id="theme-preview-content">
                            @foreach($tabs as $index => $tab)
                                @php
                                    $id = formatId($tab);
                                    $active = $index === 0 ? 'show active' : '';
                                @endphp

                                <section
                                    class="tab-pane fade {{ $active }} preview-pane"
                                    id="{{ $id }}-preview"
                                    role="tabpanel"
                                    aria-labelledby="{{ $id }}-tab"
                                    tabindex="0"
                                >
                                    @include("blocks.theme.$id")
                                </section>
                            @endforeach
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </section>
</div>
