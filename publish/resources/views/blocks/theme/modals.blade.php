@php
    use PixiiBomb\Core\Blocks\Button;
    use PixiiBomb\Core\Blocks\Modal;
    use PixiiBomb\Core\Enums\{ButtonStyle, ModalStyle};

    $primary = new Modal();
    $primary->setStyle(ModalStyle::PRIMARY->value)
        ->setTitle('Modern Modal')
        ->setBody('This modal feels more like a modern product interface. The content has more breathing room, softer separation, and less obvious framing.');
    $primary->getButtonOpen()
        ->setText('Primary Modal')
        ->setStyle(ButtonStyle::PRIMARY->value);

    $secondary = new Modal()
        ->setStyle(ModalStyle::SECONDARY->value)
        ->setTitle('Classic Modal')
        ->setBody('This modal keeps the familiar Bootstrap structure with a clear header, body, and footer.');
    $secondary->getButtonOpen()
        ->setText('Secondary Modal')
        ->setStyle(ButtonStyle::SECONDARY->value);

    $prompt = new Modal()
        ->setStyle(ModalStyle::PROMPT->value)
        ->setTitle('Delete item?')
        ->setBody('This action cannot be undone. Please confirm before continuing.')
        ->setFooter([
            new Button('Delete')->setStyle(ButtonStyle::DANGER->value),
        ]);

    $prompt->getButtonOpen()
        ->setText('Danger Modal')
        ->setStyle(ButtonStyle::DANGER->value);
@endphp

<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Modal Overrides</h1>
        <p>Preview classic and modern modal patterns using the custom design-token override system.</p>
    </header>

    <div class="component-preview-section">
        <h2>Modal Triggers</h2>

        <div class="d-flex flex-wrap gap-3">
            @block($primary)
            @block($secondary)
            @block($prompt)
        </div>
    </div>
</section>
