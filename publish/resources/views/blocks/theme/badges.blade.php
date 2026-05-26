<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Badge Overrides</h1>
        <p>Preview Bootstrap badge variants using the custom design-token override system.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Badges</h2>

        <div class="d-flex flex-wrap gap-2">
            <span class="badge text-bg-primary">Primary</span>
            <span class="badge text-bg-secondary">Secondary</span>
            <span class="badge text-bg-success">Success</span>
            <span class="badge text-bg-danger">Danger</span>
            <span class="badge text-bg-warning">Warning</span>
            <span class="badge text-bg-info">Info</span>
            <span class="badge text-bg-light">Light</span>
            <span class="badge text-bg-dark">Dark</span>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Pill Badges</h2>

        <div class="d-flex flex-wrap gap-2">
            <span class="badge rounded-pill text-bg-primary">Primary</span>
            <span class="badge rounded-pill text-bg-secondary">Secondary</span>
            <span class="badge rounded-pill text-bg-success">Success</span>
            <span class="badge rounded-pill text-bg-danger">Danger</span>
            <span class="badge rounded-pill text-bg-warning">Warning</span>
            <span class="badge rounded-pill text-bg-info">Info</span>
            <span class="badge rounded-pill text-bg-light">Light</span>
            <span class="badge rounded-pill text-bg-dark">Dark</span>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Badges In Context</h2>

        <div class="d-flex flex-column gap-3">
            <h3>
                Notifications
                <span class="badge text-bg-primary">4</span>
            </h3>

            <button type="button" class="btn btn-primary">
                Inbox <span class="badge text-bg-light">9</span>
            </button>

            <p>
                Status:
                <span class="badge text-bg-success">Active</span>
                <span class="badge text-bg-warning">Pending</span>
                <span class="badge text-bg-danger">Blocked</span>
            </p>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Notification Badges</h2>

        <div class="d-flex flex-wrap gap-4 align-items-center">
            <button type="button" class="btn btn-secondary position-relative">
                Messages
                <span class="badge text-bg-danger position-absolute top-0 start-100 translate-middle">
                    12
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>

            <button type="button" class="btn btn-secondary position-relative">
                Alerts
                <span class="badge rounded-pill text-bg-primary position-absolute top-0 start-100 translate-middle">
                    3
                    <span class="visually-hidden">new alerts</span>
                </span>
            </button>
        </div>
    </div>
</section>
