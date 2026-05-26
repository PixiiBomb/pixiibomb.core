<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Navbar Overrides</h1>
        <p>Preview brand, links, dropdowns, auth actions, and responsive navbar styling.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Navbar</h2>

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PixiiBomb</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#previewNavbarOne">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="previewNavbarOne">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Themes</a>
                        </li>

                        <li class="nav-item dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Products
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Dashboard</a></li>
                                <li><a class="dropdown-item" href="#">Components</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="#">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>User Navbar</h2>

        <nav class="navbar navbar-expand-lg navbar-user-preview">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">pixiib💣mb</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#previewNavbarTwo">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="previewNavbarTwo">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Themes</a>
                        </li>

                        <li class="nav-item dropdown user-menu">
                            <button class="user-menu-trigger" type="button" data-bs-toggle="dropdown">
                                <span class="user-avatar">P</span>
                                <span class="user-name">Pixii</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end user-dropdown">
                                <div class="user-dropdown-header">
                                    <span class="user-dropdown-avatar">P</span>

                                    <div>
                                        <strong>Pixii</strong>
                                        <span>pixii@example.com</span>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#">Dashboard</a>
                                <a class="dropdown-item" href="#">Appearance</a>
                                <a class="dropdown-item" href="#">Settings</a>

                                <div class="dropdown-divider"></div>

                                <button class="dropdown-item logout-item" type="button">
                                    Logout
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>Dark Navbar</h2>

        <nav class="navbar navbar-expand-lg navbar-dark-preview">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Studio</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#previewNavbarThree">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="previewNavbarThree">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item"><a class="nav-link active" href="#">Overview</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Projects</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Billing</a></li>
                        <li class="nav-item"><a class="btn btn-light btn-sm" href="#">Upgrade</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>Flush Navbar</h2>

        <nav class="navbar navbar-expand-lg navbar-flush">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PixiiBomb</a>

                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <a class="nav-link active" href="#">Home</a>
                    <a class="nav-link" href="#">Themes</a>
                    <a class="nav-link" href="#">Dashboard</a>
                    <a class="btn btn-primary btn-sm" href="#">Action</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>Sticky Navbar Examples</h2>

        <div class="navbar-sticky-preview">
            <nav class="navbar navbar-expand-lg navbar-flush navbar-sticky">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Flush Sticky</a>

                    <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <a class="nav-link active" href="#">Overview</a>
                        <a class="nav-link" href="#">Projects</a>
                        <a class="btn btn-primary btn-sm" href="#">Save</a>
                    </div>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-sticky navbar-rounded-sticky mt-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Rounded Sticky</a>

                    <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <a class="nav-link active" href="#">Home</a>
                        <a class="nav-link" href="#">Themes</a>
                        <a class="btn btn-secondary btn-sm" href="#">Settings</a>
                    </div>
                </div>
            </nav>

            <div class="sticky-preview-content">
                <p>Scroll this preview area to test sticky navbar behavior.</p>
                <p>Sticky navbars should remain attached to the top of this preview container.</p>
                <p>This gives you both flush and rounded sticky examples without affecting the actual app navbar.</p>
                <p>More preview content...</p>
                <p>More preview content...</p>
                <p>More preview content...</p>
                <p>More preview content...</p>
            </div>
        </div>
    </div>
</section>
