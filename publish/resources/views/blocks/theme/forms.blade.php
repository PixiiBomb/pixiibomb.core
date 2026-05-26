<section class="component-preview">
    <header class="component-preview-header">
        <h1>Bootstrap Form Overrides</h1>
        <p>Preview Bootstrap form controls, input groups, checks, switches, ranges, files, and validation states.</p>
    </header>

    <div class="component-preview-section">
        <h2>Text Inputs</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for="textInput" class="form-label">Text input</label>
                <input type="text" class="form-control" id="textInput" placeholder="Enter some text">
                <div class="form-text">Helpful supporting text for this field.</div>
            </div>

            <div class="col-12 col-md-6">
                <label for="emailInput" class="form-label">Email input</label>
                <input type="email" class="form-control" id="emailInput" placeholder="pixii@example.com">
            </div>

            <div class="col-12 col-md-6">
                <label for="passwordInput" class="form-label">Password input</label>
                <input type="password" class="form-control" id="passwordInput" placeholder="Password">
            </div>

            <div class="col-12 col-md-6">
                <label for="disabledInput" class="form-label">Disabled input</label>
                <input type="text" class="form-control" id="disabledInput" placeholder="Disabled" disabled>
            </div>

            <div class="col-12">
                <label for="textareaInput" class="form-label">Textarea</label>
                <textarea class="form-control" id="textareaInput" rows="4" placeholder="Write a longer message..."></textarea>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Selects</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for="selectInput" class="form-label">Select</label>
                <select class="form-select" id="selectInput">
                    <option selected>Choose an option</option>
                    <option value="1">Petal Spell</option>
                    <option value="2">Moonmoth</option>
                    <option value="3">Parchment</option>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label for="multiSelectInput" class="form-label">Multiple select</label>
                <select class="form-select" id="multiSelectInput" multiple>
                    <option>Buttons</option>
                    <option>Alerts</option>
                    <option>Cards</option>
                    <option>Dropdowns</option>
                </select>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Input Groups</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" placeholder="username">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" placeholder="0.00">
                    <span class="input-group-text">USD</span>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Search</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search anything...">
                    <button class="btn btn-primary" type="button">Search</button>
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Checks, Radios, Switches</h2>

        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkOne" checked>
                    <label class="form-check-label" for="checkOne">Checked checkbox</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkTwo">
                    <label class="form-check-label" for="checkTwo">Empty checkbox</label>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioPreview" id="radioOne" checked>
                    <label class="form-check-label" for="radioOne">Selected radio</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioPreview" id="radioTwo">
                    <label class="form-check-label" for="radioTwo">Other radio</label>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="switchOne" checked>
                    <label class="form-check-label" for="switchOne">Enabled switch</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="switchTwo">
                    <label class="form-check-label" for="switchTwo">Disabled switch</label>
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Range and File</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for="rangeInput" class="form-label">Range</label>
                <input type="range" class="form-range" id="rangeInput">
            </div>

            <div class="col-12 col-md-6">
                <label for="fileInput" class="form-label">File input</label>
                <input class="form-control" type="file" id="fileInput">
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Floating Labels</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com">
                    <label for="floatingEmail">Email address</label>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect">
                        <option selected>Open this menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                    </select>
                    <label for="floatingSelect">Floating select</label>
                </div>
            </div>
        </div>
    </div>

    <div class="component-preview-section">
        <h2>Validation States</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for="validInput" class="form-label">Valid input</label>
                <input type="text" class="form-control is-valid" id="validInput" value="Looks good">
                <div class="valid-feedback">Looks good!</div>
            </div>

            <div class="col-12 col-md-6">
                <label for="invalidInput" class="form-label">Invalid input</label>
                <input type="text" class="form-control is-invalid" id="invalidInput" value="Something is wrong">
                <div class="invalid-feedback">Please provide a valid value.</div>
            </div>
        </div>
    </div>
</section>
