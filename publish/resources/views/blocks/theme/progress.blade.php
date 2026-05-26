<section class="component-preview">
    <header class="component-preview-header">
        <h1>Progress Overrides</h1>
        <p>Preview Bootstrap progress bars, Tailwind-inspired meters, and custom CSS progress components.</p>
    </header>

    <div class="component-preview-section">
        <h2>Bootstrap Progress</h2>

        <div class="progress mb-3" role="progressbar" aria-label="Primary progress" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 25%">25%</div>
        </div>

        <div class="progress mb-3" role="progressbar" aria-label="Success progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: 50%">50%</div>
        </div>

        <div class="progress mb-3" role="progressbar" aria-label="Warning progress" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-warning" style="width: 75%">75%</div>
        </div>

        <div class="progress" role="progressbar" aria-label="Danger progress" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-danger" style="width: 90%">90%</div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Striped + Animated</h2>

        <div class="progress mb-3" role="progressbar" aria-label="Striped progress" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped" style="width: 60%">60%</div>
        </div>

        <div class="progress" role="progressbar" aria-label="Animated progress" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width: 45%">45%</div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Stacked Progress</h2>

        <div class="progress-stacked">
            <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                <div class="progress-bar">Design</div>
            </div>

            <div class="progress" role="progressbar" aria-label="Segment two" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                <div class="progress-bar bg-success">Build</div>
            </div>

            <div class="progress" role="progressbar" aria-label="Segment three" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                <div class="progress-bar bg-warning">Test</div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Tailwind-Inspired Progress</h2>

        <div class="progress-stack">
            <div class="progress-label">
                <span>Profile completion</span>
                <strong>72%</strong>
            </div>

            <div class="progress-meter">
                <span style="width: 72%"></span>
            </div>
        </div>

        <div class="progress-stack">
            <div class="progress-label">
                <span>Storage used</span>
                <strong>48%</strong>
            </div>

            <div class="progress-meter progress-meter-success">
                <span style="width: 48%"></span>
            </div>
        </div>

        <div class="progress-stack">
            <div class="progress-label">
                <span>Risk level</span>
                <strong>86%</strong>
            </div>

            <div class="progress-meter progress-meter-danger">
                <span style="width: 86%"></span>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Custom Progress Components</h2>

        <div class="progress-card">
            <div class="progress-card-header">
                <strong>Theme migration</strong>
                <span>8 of 10 files</span>
            </div>

            <div class="progress-meter progress-meter-animated">
                <span style="width: 80%"></span>
            </div>
        </div>

        <div class="progress-steps">
            <div class="progress-step complete">
                <span>1</span>
                <strong>Seed</strong>
            </div>

            <div class="progress-step complete">
                <span>2</span>
                <strong>Load</strong>
            </div>

            <div class="progress-step active">
                <span>3</span>
                <strong>Preview</strong>
            </div>

            <div class="progress-step">
                <span>4</span>
                <strong>Publish</strong>
            </div>
        </div>
    </div>
</section>
