@php
    use PixiiBomb\Core\Blocks\Card;
    use PixiiBomb\Core\Enums\CardStyle;
    use PixiiBomb\Core\Blocks\ComponentPreview;

    $example1 = new Card()
        ->setTitle('Default Card')
        ->setSubtitle('Simple content container')
        ->setBody('This card uses the default style and has no header or footer.');

    $example2 = new Card()
        ->setTitle('Header Card')
        ->setHeader('Featured')
        ->setBody('*example2-body');

    $example4 = new Card()
        ->setTitle('Action Card')
        ->setBody('*example4-body');

    $example5 = new Card()
        ->setTitle('Image Card')
        ->setThumbnail('Image Preview')
        ->setBody('Use image cards for previews, thumbnails, products, posts, or visual summaries.');

    $example6 = new Card()
        ->setTitle('Horizontal Card')
        ->setStyle(CardStyle::HORIZONTAL->value)
        ->setThumbnail('Image Preview')
        ->setBody('This layout is useful for compact media lists and dashboard summaries.');

    $sections = [
        [
            'title' => 'Default Style',
            'section' => [$example1, $example2, $example4]
        ],
        [
            'title' => 'Image Cards',
            'section' => [$example5, $example6]
        ]
    ];

    $preview = new ComponentPreview($sections);
@endphp

@section('example2-body')
    <p>This card includes a header area for context or grouping.</p>
    <button class="btn btn-primary">Primary Action</button>
@endsection

@section('example4-body')
    <p>Cards often pair short content with one or more actions.</p>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-primary">Save</button>
        <button class="btn btn-secondary">Cancel</button>
    </div>
@endsection

@block($preview)

<hr>

<section class="component-preview">
    <div class="component-preview-section">
        <h3>Dashboard Cards</h3>

        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <span class="stat-label">Projects</span>
                        <strong class="stat-value">24</strong>
                        <span class="stat-note">+12% this month</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <span class="stat-label">Members</span>
                        <strong class="stat-value">8</strong>
                        <span class="stat-note">+2 new members</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <span class="stat-label">Revenue</span>
                        <strong class="stat-value">$12,540</strong>
                        <span class="stat-note">+8% growth</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h3>List Card</h3>

        <div class="card">
            <div class="card-header">
                Recent Activity
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">New project created</li>
                <li class="list-group-item">Invoice paid</li>
                <li class="list-group-item">Team member added</li>
            </ul>

            <div class="card-footer">
                Updated just now
            </div>
        </div>
    </div>
</section>
