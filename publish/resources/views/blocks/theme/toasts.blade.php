<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Toast Overrides</h1>
        <p>Preview toast headers, bodies, stacked toasts, and custom status toast styles.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Toasts</h2>

        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="toast-dot"></span>
                <strong class="me-auto">PixiiBomb</strong>
                <small>Just now</small>
                <button type="button" class="btn-close ms-2 mb-1" aria-label="Close"></button>
            </div>

            <div class="toast-body">
                Your appearance settings were saved successfully.
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Stacked Toasts</h2>

        <div class="toast-container position-static">
            <div class="toast show toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <span class="toast-dot"></span>
                    <strong class="me-auto">Success</strong>
                    <small>1 min ago</small>
                    <button type="button" class="btn-close ms-2 mb-1" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    Theme files were published and seeded.
                </div>
            </div>

            <div class="toast show toast-warning" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <span class="toast-dot"></span>
                    <strong class="me-auto">Warning</strong>
                    <small>2 mins ago</small>
                    <button type="button" class="btn-close ms-2 mb-1" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    One thumbnail is missing from the theme folder.
                </div>
            </div>

            <div class="toast show toast-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <span class="toast-dot"></span>
                    <strong class="me-auto">Error</strong>
                    <small>3 mins ago</small>
                    <button type="button" class="btn-close ms-2 mb-1" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    The selected stylesheet could not be loaded.
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Modern Toast</h2>

        <div class="toast show modern-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <div class="toast-icon">✓</div>

                <div class="toast-copy">
                    <strong>Saved successfully</strong>
                    <span>Your user settings now use the selected theme and palette.</span>
                </div>

                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>
        </div>
    </div>
</section>
