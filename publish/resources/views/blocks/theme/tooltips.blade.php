<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Tooltip Overrides</h1>
        <p>Preview Bootstrap tooltips in every direction, plus custom helper tooltip patterns.</p>
    </header>

    <div class="component-preview-section">
        <h2>Bootstrap Tooltips</h2>

        <div class="d-flex flex-wrap gap-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                Top Tooltip
            </button>

            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on right">
                Right Tooltip
            </button>

            <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">
                Bottom Tooltip
            </button>

            <button type="button" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="left" title="Tooltip on left">
                Left Tooltip
            </button>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>HTML Tooltip</h2>

        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="tooltip"
            data-bs-html="true"
            title="<strong>HTML tooltip</strong><br><span>Supports richer tooltip content.</span>"
        >
            HTML Tooltip
        </button>
    </div>

    <div class="component-preview-section">
        <h2>Custom CSS Tooltip</h2>

        <div class="d-flex flex-wrap gap-3">
            <span class="tooltip-hint" data-tooltip="This is a simple CSS-only tooltip.">
                Hover hint
            </span>

            <span class="tooltip-hint tooltip-hint-primary" data-tooltip="This hint uses the primary color.">
                Primary hint
            </span>

            <span class="tooltip-hint tooltip-hint-danger" data-tooltip="This hint communicates risk or danger.">
                Danger hint
            </span>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((element) => {
        bootstrap.Tooltip.getOrCreateInstance(element);
    });
</script>
