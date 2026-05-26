@php
    $id = $block->getId();
    $buttonOpen = $block->getButtonOpen();
    $title = $block->getTitle();
    $body = $block->getBody();
    $footer = $block->getFooter();
    $style = $block->getStyle();
@endphp

@if(!is_null($buttonOpen))
    @block($buttonOpen)
@endif

<div class="modal fade {{ $style }}" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            @if(!empty($title))
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{{ $id }}Label">
                        {{ $title }}
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            @endif

            @isset($body)
                <div class="modal-body">
                    @if(is_string($body))
                        {{ $body }}
                    @else
                        @block($body)
                    @endif
                </div>
            @endisset

            @if(!empty($footer))
                <div class="modal-footer">
                    @foreach($footer as $button)
                        @block($button)
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
