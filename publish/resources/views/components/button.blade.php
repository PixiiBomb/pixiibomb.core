@php
    if (!isset($block)) {
        throw new RuntimeException('Button component requires a $block instance.');
    }
@endphp

<button
    type="button"
    class="btn {{ $block->getStyle() }} {{ $block->renderAttributeValue('class') }}"
    id="{{ $block->renderAttributeValue('id') }}"
    {!! $block->renderAttributes(['class', 'id', 'type']) !!}
>
    {{ $block->getText() }}
</button>
