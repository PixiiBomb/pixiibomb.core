@require($page)


@foreach($page->getBlocks() as $key=>$block)
    @php
        $view = $block?->getView();
        $componentName = $block?->getComponentName();

        $attributes = new \Illuminate\View\ComponentAttributeBag($block?->getParameters())
    @endphp

    @if(isset($componentName) && !isset($view))
        <x-dynamic-component :component="$componentName" {{ $attributes }} />
    @endif

    @isset($view)
        <!-- View: {{ $block->getRequestedView() }} -->
        @include($block->getView(), ['block' => $block])
    @endisset

@endforeach
