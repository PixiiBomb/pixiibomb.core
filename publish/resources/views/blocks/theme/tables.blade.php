<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Table Overrides</h1>
        <p>Preview table variants, striped rows, hover states, borders, and responsive wrappers.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Table</h2>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Owner</th>
                    <th>Updated</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Theme Engine</td>
                    <td><span class="badge text-bg-success">Active</span></td>
                    <td>Pixii</td>
                    <td>Today</td>
                </tr>
                <tr>
                    <td>Component Library</td>
                    <td><span class="badge text-bg-warning">Pending</span></td>
                    <td>Design Team</td>
                    <td>Yesterday</td>
                </tr>
                <tr>
                    <td>Billing Portal</td>
                    <td><span class="badge text-bg-info">Review</span></td>
                    <td>Operations</td>
                    <td>May 16</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Striped + Hover Table</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Plan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>PixiiBomb</td>
                    <td>pixii@example.com</td>
                    <td>Admin</td>
                    <td>Pro</td>
                </tr>
                <tr>
                    <td>Demo User</td>
                    <td>demo@example.com</td>
                    <td>Member</td>
                    <td>Basic</td>
                </tr>
                <tr>
                    <td>Guest User</td>
                    <td>guest@example.com</td>
                    <td>Viewer</td>
                    <td>Free</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Bordered + Compact Table</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>theme</td>
                    <td>pixii</td>
                    <td>string</td>
                </tr>
                <tr>
                    <td>palette</td>
                    <td>petalspell</td>
                    <td>string</td>
                </tr>
                <tr>
                    <td>active</td>
                    <td>true</td>
                    <td>boolean</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Contextual Rows</h2>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Event</th>
                    <th>Type</th>
                    <th>Message</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-primary">
                    <td>Theme changed</td>
                    <td>Primary</td>
                    <td>The active theme was updated.</td>
                </tr>
                <tr class="table-success">
                    <td>Saved</td>
                    <td>Success</td>
                    <td>User settings were saved.</td>
                </tr>
                <tr class="table-warning">
                    <td>Pending</td>
                    <td>Warning</td>
                    <td>A palette is missing a thumbnail.</td>
                </tr>
                <tr class="table-danger">
                    <td>Error</td>
                    <td>Danger</td>
                    <td>The stylesheet could not be found.</td>
                </tr>
                <tr class="table-info">
                    <td>Note</td>
                    <td>Info</td>
                    <td>A fallback theme was loaded.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
