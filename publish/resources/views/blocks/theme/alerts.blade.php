<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Alert Overrides</h1>
        <p>Preview all Bootstrap alert variants using the custom design-token override system.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Alerts</h2>

        <div class="alert alert-primary" role="alert">
            <strong>Primary:</strong> This is a primary alert for general highlighted information.
        </div>

        <div class="alert alert-secondary" role="alert">
            <strong>Secondary:</strong> This is a secondary alert for neutral supporting information.
        </div>

        <div class="alert alert-success" role="alert">
            <strong>Success:</strong> This is a success alert for completed actions.
        </div>

        <div class="alert alert-danger" role="alert">
            <strong>Danger:</strong> This is a danger alert for errors or destructive warnings.
        </div>

        <div class="alert alert-warning" role="alert">
            <strong>Warning:</strong> This is a warning alert for cautionary information.
        </div>

        <div class="alert alert-info" role="alert">
            <strong>Info:</strong> This is an info alert for helpful notes and context.
        </div>

        <div class="alert alert-light" role="alert">
            <strong>Light:</strong> This is a light alert for subtle page-level information.
        </div>

        <div class="alert alert-dark" role="alert">
            <strong>Dark:</strong> This is a dark alert for high contrast messaging.
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Alerts With Links</h2>

        <div class="alert alert-primary" role="alert">
            A primary alert with <a href="#" class="alert-link">an example link</a>.
        </div>

        <div class="alert alert-success" role="alert">
            A success alert with <a href="#" class="alert-link">an example link</a>.
        </div>

        <div class="alert alert-danger" role="alert">
            A danger alert with <a href="#" class="alert-link">an example link</a>.
        </div>

        <div class="alert alert-warning" role="alert">
            A warning alert with <a href="#" class="alert-link">an example link</a>.
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Dismissible Alerts</h2>

        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Heads up!</strong> This primary alert can be dismissed.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Saved!</strong> Your changes were saved successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something went wrong while processing your request.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Alert With Extra Content</h2>

        <div class="alert alert-info" role="alert">
            <h3 class="alert-heading">Helpful note</h3>
            <p>
                This alert includes a heading, body copy, a divider, and supporting text.
                It helps test spacing and readability inside alert components.
            </p>
            <hr>
            <p class="mb-0">
                Use this pattern when the alert needs more explanation than a single sentence.
            </p>
        </div>
    </div>
</section>
