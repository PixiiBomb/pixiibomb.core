<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap List Group Overrides</h1>
        <p>Preview standard list groups, active items, disabled states, badges, headers, flush lists, and Tailwind-inspired layouts.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard List Group</h2>

        <ul class="list-group">
            <li class="list-group-item active">Active item</li>
            <li class="list-group-item">Standard item</li>
            <li class="list-group-item">Another item</li>
            <li class="list-group-item disabled">Disabled item</li>
        </ul>
    </div>

    <div class="component-preview-section">
        <h2>Links and Buttons</h2>

        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action">Profile</a>
            <a href="#" class="list-group-item list-group-item-action">Appearance</a>
            <button type="button" class="list-group-item list-group-item-action">Billing</button>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Badges</h2>

        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Notifications
                <span class="badge text-bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Messages
                <span class="badge text-bg-success rounded-pill">3</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Warnings
                <span class="badge text-bg-warning rounded-pill">2</span>
            </li>
        </ul>
    </div>

    <div class="component-preview-section">
        <h2>Contextual List Items</h2>

        <ul class="list-group">
            <li class="list-group-item list-group-item-primary">Primary contextual item</li>
            <li class="list-group-item list-group-item-secondary">Secondary contextual item</li>
            <li class="list-group-item list-group-item-success">Success contextual item</li>
            <li class="list-group-item list-group-item-danger">Danger contextual item</li>
            <li class="list-group-item list-group-item-warning">Warning contextual item</li>
            <li class="list-group-item list-group-item-info">Info contextual item</li>
            <li class="list-group-item list-group-item-light">Light contextual item</li>
            <li class="list-group-item list-group-item-dark">Dark contextual item</li>
        </ul>
    </div>

    <div class="component-preview-section">
        <h2>Flush List Group</h2>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Flush item one</li>
            <li class="list-group-item">Flush item two</li>
            <li class="list-group-item">Flush item three</li>
        </ul>
    </div>

    <div class="component-preview-section">
        <h2>Custom Content</h2>

        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
                <div class="list-item-header">
                    <h3>Theme updated</h3>
                    <small>Just now</small>
                </div>
                <p>The active palette was changed to Petal Spell.</p>
                <small>Appearance settings</small>
            </a>

            <a href="#" class="list-group-item list-group-item-action">
                <div class="list-item-header">
                    <h3>New component added</h3>
                    <small>2 hours ago</small>
                </div>
                <p>Cards, alerts, and badges were added to the preview system.</p>
                <small>Component library</small>
            </a>

            <a href="#" class="list-group-item list-group-item-action">
                <div class="list-item-header">
                    <h3>User setting saved</h3>
                    <small>Yesterday</small>
                </div>
                <p>Your selected theme is now stored in the database.</p>
                <small>User settings</small>
            </a>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Tailwind-Inspired List</h2>

        <div class="tailwind-list">
            <a href="#" class="tailwind-list-item">
                <div class="tailwind-list-icon">P</div>

                <div class="tailwind-list-copy">
                    <strong>Pixii Theme</strong>
                    <span>Soft storybook theme with magical interface details.</span>
                </div>

                <span class="badge text-bg-primary">Active</span>
            </a>

            <a href="#" class="tailwind-list-item">
                <div class="tailwind-list-icon">B</div>

                <div class="tailwind-list-copy">
                    <strong>Base Theme</strong>
                    <span>Modern product UI theme with clean components.</span>
                </div>

                <span class="badge text-bg-secondary">Available</span>
            </a>

            <a href="#" class="tailwind-list-item">
                <div class="tailwind-list-icon">S</div>

                <div class="tailwind-list-copy">
                    <strong>Saved Settings</strong>
                    <span>User preference data is stored and loaded automatically.</span>
                </div>

                <span class="badge text-bg-success">Synced</span>
            </a>
        </div>
    </div>
</section>
