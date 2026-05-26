@php
use \PixiiBomb\Core\Data\Block;
@endphp

@if(is_null($content))
    @php throw new InvalidArgumentException('Block content cannot be null when rendering.'); @endphp
@elseif(is_string($content))
    {{ $content }}
@elseif($content instanceof \PixiiBomb\Core\Data\Section)
    @yield($content->name)
@elseif($content instanceof \PixiiBomb\Core\Data\Block)
    @block($content)
@elseif(is_array($content))
    @foreach($content as $item)
        @include('components.partials.content', ['content' => $item])
    @endforeach
@else
    @php throw new InvalidArgumentException('Unsupported block content type.'); @endphp
@endif
