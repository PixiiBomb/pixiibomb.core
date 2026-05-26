@php
    use PixiiBomb\Core\Blocks\Breadcrumb;
    use PixiiBomb\Core\Enums\BreadcrumbStyle;
    use PixiiBomb\Core\Blocks\ComponentPreview;
    use PixiiBomb\Core\Data\MenuItem;

    $items = [
            new MenuItem('Home'),
            new MenuItem('Themes'),
            new MenuItem('Breadcrumbs', '#', true)
        ];

    $example1 = new Breadcrumb()
        ->setItems($items);

    $example2 = new Breadcrumb()
        ->setStyle(BreadcrumbStyle::GROUP->value)
        ->setItems($items);

    $example3 = new Breadcrumb()
        ->setStyle(BreadcrumbStyle::PILL->value)
        ->setItems($items);

    $sections = [
        [
            'title' => 'Standard Breadcrumb',
            'section' => [$example1]
        ],
        [
            'title' => 'Grouped Breadcrumb',
            'section' => [$example2]
        ],
        [
            'title' => 'Pill Breadcrumb',
            'section' => [$example3]
        ],
    ];

    $preview = new ComponentPreview($sections)
        ->setTitle('Breadcrumbs')
        ->setDescription('Breadcrumbs help users understand where they are within the interface and provide quick navigation back through the hierarchy.')
@endphp

@block($preview)
