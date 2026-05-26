@php
    $id = $block->getId();
    $thumbnail = $block->getThumbnail();
    $header = $block->getHeader();
    $body = $block->getBody();
    $footer = $block->getFooter();
    $title = $block->getTitle();
    $subtitle = $block->getSubtitle();
    $style = $block->getStyle();
@endphp

<div class="card {{ $style }}" id="{{ $id }}">
    @isset($header)
        <div class="card-header">
            @include('components.partials.content', ['content' => $header])
        </div>
    @endisset

    @isset($thumbnail)
        @if(File::exists($thumbnail))
            <img class="card-img-top card-preview-image"
                 src="{{ asset($thumbnail) }}" alt="Card Image">
        @else
            <div class="card-img-top card-preview-image">
                {{ $thumbnail }}
            </div>
        @endif
    @endisset

    @isset($body)
        <div class="card-body">
            @isset($title)
                <h3 class="card-title">{{ $title }}</h3>
            @endisset

            @isset($subtitle)
                <h4 class="card-subtitle mb-2 text-muted">{{ $subtitle }}</h4>
            @endisset

            <span class="card-text">
                @include('components.partials.content', ['content' => $body])
            </span>
        </div>
    @endisset

    @isset($footer)
        <div class="card-footer">
            @include('components.partials.content', ['content' => $footer])
        </div>
    @endisset
</div>
