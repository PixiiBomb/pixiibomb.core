<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Tabs Overrides</h1>
        <p>Preview nav tabs, pills, underline tabs, vertical tabs, and Tailwind-inspired tab styles.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Tabs</h2>

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" type="button">Overview</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" type="button">Settings</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link disabled" type="button" disabled>Disabled</button>
            </li>
        </ul>

        <div class="tab-preview-panel">
            Standard Bootstrap tabs with a themed active state and content panel.
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Pills</h2>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <button class="nav-link active" type="button">Profile</button>
            </li>

            <li class="nav-item">
                <button class="nav-link" type="button">Billing</button>
            </li>

            <li class="nav-item">
                <button class="nav-link" type="button">Security</button>
            </li>
        </ul>
    </div>

    <div class="component-preview-section">
        <h2>Underline Tabs</h2>

        <ul class="nav nav-underline">
            <li class="nav-item">
                <button class="nav-link active" type="button">Activity</button>
            </li>

            <li class="nav-item">
                <button class="nav-link" type="button">Projects</button>
            </li>

            <li class="nav-item">
                <button class="nav-link" type="button">Members</button>
            </li>
        </ul>
    </div>

    <div class="component-preview-section">
        <h2>Vertical Tabs</h2>

        <div class="vertical-tabs-preview">
            <div class="nav flex-column nav-pills vertical-tabs">
                <button class="nav-link active" type="button">Account</button>
                <button class="nav-link" type="button">Appearance</button>
                <button class="nav-link" type="button">Notifications</button>
                <button class="nav-link" type="button">Integrations</button>
            </div>

            <div class="tab-preview-panel">
                Vertical tabs are useful for settings pages and dashboards.
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Tailwind-Inspired Segmented Tabs</h2>

        <div class="segmented-tabs">
            <button class="active" type="button">Monthly</button>
            <button type="button">Quarterly</button>
            <button type="button">Yearly</button>
        </div>
    </div>
</section>
