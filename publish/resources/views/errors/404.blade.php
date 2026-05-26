<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 text-center">

            <div class="display-1 fw-bold text-secondary mb-2">404</div>

            <h1 class="fw-semibold mb-3">Page not found</h1>

            <p class="text-muted mb-4">
                The page you were looking for doesn’t exist, moved somewhere else,
                or was never summoned from the void in the first place.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
                <a href="/" class="btn btn-primary">
                    Go Home
                </a>

                <button class="btn btn-outline-secondary" onclick="history.back()">
                    Go Back
                </button>
            </div>

            @debug
            <div class="alert alert-warning text-start mx-auto" style="max-width: 720px;">
                <div class="fw-semibold mb-1">Debug info</div>
                <div class="small">
                    URL: <code>{{ request()->fullUrl() }}</code>
                </div>
            </div>
            @enddebug

        </div>
    </div>

</div>
