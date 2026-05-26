<div class="container py-5">

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-8 text-center">
            <h1 class="fw-bold mb-2">🧚💣 PixiiBomb Core Installed 🎉</h1>
            <p class="text-muted mb-3">
                Your application is up and running with the PixiiBomb framework layer.
            </p>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <span class="badge text-bg-primary">Bootstrap Ready</span>
                <span class="badge text-bg-success">Blade Components</span>
                <span class="badge text-bg-secondary">PageController</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Views</h5>
                    <p class="card-text text-muted">
                        Blocks, layouts, and templates are now driven through the Page abstraction.
                    </p>
                    <span class="badge text-bg-light border">blocks.*.*</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Controllers</h5>
                    <p class="card-text text-muted">
                        Controllers extend <code>PageController</code> for consistent rendering.
                    </p>
                    <span class="badge text-bg-light border">parent::view()</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tooling</h5>
                    <p class="card-text text-muted">
                        Artisan helpers accelerate setup and scaffolding.
                    </p>
                    <span class="badge text-bg-light border">pixii:install</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-8">
            <div class="alert alert-info d-flex align-items-start gap-3">
                <div class="fw-bold">Next steps</div>
                <div class="flex-fill">
                    <ul class="mb-0 ps-3">
                        <li>Create your first controller.</li>
                        <li>Customize your layout or theme.</li>
                        <li>Start building blocks.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 text-center">
            <button
                class="btn btn-primary btn-lg"
                data-bs-toggle="tooltip"
                data-tooltip-target="pixii-tooltip"
            >
                Hover me
            </button>

            <template id="pixii-tooltip">
                <div class="fw-semibold">Bootstrap tooltips are wired correctly.</div>
                <div class="small text-muted">Your JS pipeline is alive.</div>
            </template>
        </div>
    </div>

</div>
