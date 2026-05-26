@php
    if(!isset($page))
    {
        dd("Unable to display includes.blocks.blade.php - the page object is not set. Please refer to documentation for additional information");
    }

    if (empty($page->getBlocks()))
    {
        dd("There are no blocks on this page!");
    }
@endphp

@foreach($page->getBlocks() as $key=>$block)
    <!-- View: {{ $block->getRequestedView() }} -->
    @block($block)
@endforeach
