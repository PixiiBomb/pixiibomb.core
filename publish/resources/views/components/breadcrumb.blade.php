@php
    $id = $block->getId();
    $style = $block->getStyle();
    $items = $block->getItems();
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb {{ $style }}">
        @foreach ($items as $item)
            @php
                $active = $item->active ? 'active' : '';
                $aria = $item->active ? 'aria-current="page"' : '';
            @endphp

            <li class="breadcrumb-item {{ $active }}" {{ $aria }}>
                @if($item->active)
                    <span>{{ $item->label }}</span>
                @else
                    <a href="#">{{ $item->label }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
