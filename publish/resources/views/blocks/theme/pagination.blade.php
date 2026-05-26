<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Pagination Overrides</h1>
        <p>Preview standard pagination, disabled states, active states, sizing, and Tailwind-inspired pagination.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Pagination</h2>

        <nav aria-label="Standard pagination">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>

                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>Pagination Sizes</h2>

        <nav aria-label="Large pagination">
            <ul class="pagination pagination-lg">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>

        <nav aria-label="Small pagination">
            <ul class="pagination pagination-sm">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>Icon Pagination</h2>

        <nav aria-label="Icon pagination">
            <ul class="pagination pagination-icons">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">‹</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>

                <li class="page-item active">
                    <a class="page-link" href="#">2</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">›</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="component-preview-section">
        <h2>Tailwind-Inspired Pagination</h2>

        <nav class="tailwind-pagination" aria-label="Tailwind-inspired pagination">
            <a class="tailwind-page-control disabled" href="#">Previous</a>

            <div class="tailwind-page-list">
                <a class="active" href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <span>...</span>
                <a href="#">8</a>
            </div>

            <a class="tailwind-page-control" href="#">Next</a>
        </nav>
    </div>
</section>
