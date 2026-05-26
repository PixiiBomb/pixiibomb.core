<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Offcanvas Overrides</h1>
        <p>Preview side drawers, placement options, headers, bodies, and modern drawer layouts.</p>
    </header>

    <div class="component-preview-section">
        <h2>Offcanvas Triggers</h2>

        <div class="d-flex flex-wrap gap-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart">
                Start Drawer
            </button>

            <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd">
                End Drawer
            </button>

            <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop">
                Top Drawer
            </button>

            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom">
                Bottom Drawer
            </button>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasStartLabel">Navigation Drawer</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <p>This is a standard left-side offcanvas drawer.</p>

            <nav class="offcanvas-menu">
                <a class="active" href="#">Dashboard</a>
                <a href="#">Profile</a>
                <a href="#">Appearance</a>
                <a href="#">Billing</a>
                <a href="#">Settings</a>
            </nav>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <div>
                <h2 class="offcanvas-title" id="offcanvasEndLabel">Settings</h2>
                <p class="offcanvas-subtitle">Update your workspace preferences.</p>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="offcanvas-card">
                <strong>Theme</strong>
                <span>Choose your preferred interface style.</span>
            </div>

            <div class="offcanvas-card">
                <strong>Notifications</strong>
                <span>Control how PixiiBomb reaches you.</span>
            </div>

            <div class="offcanvas-card">
                <strong>Billing</strong>
                <span>Manage invoices and subscription details.</span>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasTopLabel">Announcement Drawer</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <p>This top drawer can be used for announcements, search, or global notices.</p>
            <button class="btn btn-primary">Take Action</button>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasBottomLabel">Bottom Sheet</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <p>Bottom sheets work well for mobile actions and quick selection panels.</p>

            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary">Confirm</button>
                <button class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </div>
    </div>
</section>
