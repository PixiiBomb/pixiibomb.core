<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Accordion Overrides</h1>
        <p>Preview Bootstrap accordion states, flush accordions, and open panels.</p>
    </header>

    <div class="component-preview-section">
        <h2>Standard Accordion</h2>

        <div class="accordion" id="standardAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#standardOne" aria-expanded="true" aria-controls="standardOne">
                        Open accordion item
                    </button>
                </h3>

                <div id="standardOne" class="accordion-collapse collapse show" data-bs-parent="#standardAccordion">
                    <div class="accordion-body">
                        This is the visible accordion content area. It should feel like part of the same component surface.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#standardTwo" aria-expanded="false" aria-controls="standardTwo">
                        Collapsed accordion item
                    </button>
                </h3>

                <div id="standardTwo" class="accordion-collapse collapse" data-bs-parent="#standardAccordion">
                    <div class="accordion-body">
                        This content appears when the second accordion item is expanded.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#standardThree" aria-expanded="false" aria-controls="standardThree">
                        Another collapsed item
                    </button>
                </h3>

                <div id="standardThree" class="accordion-collapse collapse" data-bs-parent="#standardAccordion">
                    <div class="accordion-body">
                        Accordions are useful for dense settings panels, FAQs, filters, and grouped forms.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Flush Accordion</h2>

        <div class="accordion accordion-flush" id="flushAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flushOne" aria-expanded="true" aria-controls="flushOne">
                        Flush open item
                    </button>
                </h3>

                <div id="flushOne" class="accordion-collapse collapse show" data-bs-parent="#flushAccordion">
                    <div class="accordion-body">
                        Flush accordions remove the outer radius and are useful inside cards or panels.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flushTwo" aria-expanded="false" aria-controls="flushTwo">
                        Flush collapsed item
                    </button>
                </h3>

                <div id="flushTwo" class="accordion-collapse collapse" data-bs-parent="#flushAccordion">
                    <div class="accordion-body">
                        This is another flush accordion section.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Minimal Accordion</h2>

        <div class="accordion minimal-accordion" id="minimalAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#minimalOne" aria-expanded="true" aria-controls="minimalOne">
                        What makes this theme system different?
                    </button>
                </h3>

                <div id="minimalOne" class="accordion-collapse collapse show" data-bs-parent="#minimalAccordion">
                    <div class="accordion-body">
                        The ruleset defines the contract, palettes define colors, and theme structures redesign reusable components.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#minimalTwo" aria-expanded="false" aria-controls="minimalTwo">
                        Can each theme feel completely different?
                    </button>
                </h3>

                <div id="minimalTwo" class="accordion-collapse collapse" data-bs-parent="#minimalAccordion">
                    <div class="accordion-body">
                        Yes. Base can feel modern and product-focused, while Pixii can feel whimsical, magical, and storybook-inspired.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#minimalThree" aria-expanded="false" aria-controls="minimalThree">
                        Where should page-specific styles live?
                    </button>
                </h3>

                <div id="minimalThree" class="accordion-collapse collapse" data-bs-parent="#minimalAccordion">
                    <div class="accordion-body">
                        Page styles should architect the layout. Theme files should only redesign reusable UI components.
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
