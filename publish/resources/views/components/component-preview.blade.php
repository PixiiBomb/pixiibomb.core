@php
    if (!isset($block))
    {
        dump('Component preview could not be displayed because the block is missing.');
        return;
    }
@endphp

<section class="component-preview">
    <header class="component-preview-header">
        <h3>{{ $block->getTitle() }}</h3>
        <p>{{ $block->getDescription() }}</p>
    </header>

    @foreach($sections as $key=>$section)
        <div class="component-preview-section">
            <h4>{{ $section['title'] }}</h4>
            <div class="row g-2">
                @foreach ($section['section'] as $card)
                    <div class="col-12">
                        @block($card)
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>
