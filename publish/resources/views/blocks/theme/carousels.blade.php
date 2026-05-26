<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Carousel Overrides</h1>
        <p>Preview Bootstrap carousel slides, indicators, controls, and captions.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Carousel</h2>

        <div id="standardCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#standardCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#standardCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#standardCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-preview-surface primary-slide">
                        <div class="carousel-preview-content">
                            <span class="carousel-eyebrow">Featured</span>
                            <h3>Primary Slide</h3>
                            <p>This slide previews a hero-like carousel item with controls and indicators.</p>
                        </div>
                    </div>

                    <div class="carousel-caption d-none d-md-block">
                        <h4>First slide label</h4>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-preview-surface secondary-slide">
                        <div class="carousel-preview-content">
                            <span class="carousel-eyebrow">Updates</span>
                            <h3>Secondary Slide</h3>
                            <p>Use this for dashboard highlights, product previews, or onboarding panels.</p>
                        </div>
                    </div>

                    <div class="carousel-caption d-none d-md-block">
                        <h4>Second slide label</h4>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-preview-surface accent-slide">
                        <div class="carousel-preview-content">
                            <span class="carousel-eyebrow">Details</span>
                            <h3>Accent Slide</h3>
                            <p>This helps test caption contrast, surface depth, and carousel movement states.</p>
                        </div>
                    </div>

                    <div class="carousel-caption d-none d-md-block">
                        <h4>Third slide label</h4>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#standardCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#standardCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Fade Carousel</h2>

        <div id="fadeCarousel" class="carousel slide carousel-fade compact-carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-preview-surface note-slide">
                        <div class="carousel-preview-content">
                            <span class="carousel-eyebrow">Note</span>
                            <h3>Fade transition</h3>
                            <p>This variant uses Bootstrap’s carousel fade behavior.</p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-preview-surface success-slide">
                        <div class="carousel-preview-content">
                            <span class="carousel-eyebrow">Success</span>
                            <h3>Soft motion</h3>
                            <p>Useful for onboarding, announcements, and featured content.</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#fadeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#fadeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
