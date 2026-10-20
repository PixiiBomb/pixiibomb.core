<div class="section-header">
    <div class="section-title">CORE TRAITS</div>

    <h1>HasAssets</h1>

    <p class="lead">
        Attach Vite stylesheets and scripts to a PixiiBomb object.
    </p>

    <p>
        <strong>Namespace:</strong>
        <code>PixiiBomb\Core\Traits\HasAssets</code>
    </p>
</div>

<x-pixii::doc-section
    title="Overview"
    description="Attach application and PixiiBomb package assets through logical resource paths.">
    <p>
        The <code>HasAssets</code> trait adds stylesheet and script collections
        to a class. These assets can be rendered through Laravel's Vite
        integration by a template or layout.
    </p>

    <p>
        Asset paths are resolved by
        <code>PixiiBomb\Core\Support\PixiiAssetManager</code>. Unqualified
        asset names resolve from the Laravel application's
        <code>resources</code> directory, while names beginning with
        <code>pixii::</code> resolve from registered PixiiBomb package resource
        directories.
    </p>

    <p>
        The applicable <code>css</code> or <code>js</code> directory and file
        extension are supplied automatically based on whether
        <code>setStylesheets()</code> or <code>setScripts()</code> is used.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Basic Usage"
    description="Attach stylesheets and scripts through their logical asset names.">
    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                use PixiiBomb\Core\Data\Block;

                $block = (new Block())
                ->setStylesheets([
                'blocks/hero-banner',
                ])
                ->setScripts([
                'blocks/hero-banner',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Both methods accept an array, even when only one asset is being
        attached. They return the current object and can be included in a
        fluent configuration chain.
    </p>

    <p>
        In this example, the stylesheet and script are resolved from the
        Laravel application's resource directories.
    </p>

    <x-pixii::code-example language="text" label="Resolved Paths">
        <x-slot:source>
            @verbatim
                resources/css/blocks/hero-banner.css
                resources/js/blocks/hero-banner.js
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Application Assets"
    description="Unqualified asset names resolve from the Laravel application's resources directory.">
    <p>
        An asset name without a namespace is treated as an application
        resource. Stylesheets resolve beneath <code>resources/css</code>, and
        scripts resolve beneath <code>resources/js</code>.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block
                ->setStylesheets([
                'pages/dashboard',
                'components/status-card',
                ])
                ->setScripts([
                'pages/dashboard',
                'components/status-card',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Logical name</th>
                <th scope="col">Method</th>
                <th scope="col">Resolved path</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><code>pages/dashboard</code></td>
                <td><code>setStylesheets()</code></td>
                <td><code>resources/css/pages/dashboard.css</code></td>
            </tr>

            <tr>
                <td><code>pages/dashboard</code></td>
                <td><code>setScripts()</code></td>
                <td><code>resources/js/pages/dashboard.js</code></td>
            </tr>

            <tr>
                <td><code>components/status-card</code></td>
                <td><code>setStylesheets()</code></td>
                <td>
                    <code>resources/css/components/status-card.css</code>
                </td>
            </tr>

            <tr>
                <td><code>components/status-card</code></td>
                <td><code>setScripts()</code></td>
                <td>
                    <code>resources/js/components/status-card.js</code>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="PixiiBomb Package Assets"
    description="Use the pixii namespace to load resources supplied by a PixiiBomb package.">
    <p>
        Prefix an asset name with <code>pixii::</code> to resolve it from the
        resource directories registered by installed PixiiBomb packages.
    </p>

    <p>
        The shared namespace means the consuming developer does not need to
        know whether the resource is provided by PixiiBomb Core, UI, API, AI,
        or another PixiiBomb package.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block
                ->setStylesheets([
                'pixii::blocks/ui-welcome',
                ])
                ->setScripts([
                'pixii::blocks/ui-welcome',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="text" label="Resolved Paths">
        <x-slot:source>
            @verbatim
                vendor/pixiibomb/ui/resources/css/blocks/ui-welcome.css
                vendor/pixiibomb/ui/resources/js/blocks/ui-welcome.js
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Package ownership is determined automatically by
        <code>PixiiAssetManager</code>. The first step is locating the
        registered package resource directory that contains the requested
        asset.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Automatic Path Resolution"
    description="The asset method supplies the resource directory and file extension.">
    <p>
        Logical asset names should not include the leading
        <code>resources/css</code> or <code>resources/js</code> directory.
        Those directories are selected automatically by the method being
        called.
    </p>

    <p>
        The corresponding <code>.css</code> or <code>.js</code> extension is
        also appended when it is not already present.
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Assigned value</th>
                <th scope="col">Method</th>
                <th scope="col">Resolved suffix</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><code>blocks/hero-banner</code></td>
                <td><code>setStylesheets()</code></td>
                <td><code>css/blocks/hero-banner.css</code></td>
            </tr>

            <tr>
                <td><code>blocks/hero-banner.css</code></td>
                <td><code>setStylesheets()</code></td>
                <td><code>css/blocks/hero-banner.css</code></td>
            </tr>

            <tr>
                <td><code>blocks/hero-banner</code></td>
                <td><code>setScripts()</code></td>
                <td><code>js/blocks/hero-banner.js</code></td>
            </tr>

            <tr>
                <td><code>blocks/hero-banner.js</code></td>
                <td><code>setScripts()</code></td>
                <td><code>js/blocks/hero-banner.js</code></td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Minified Assets"
    description="Include .min in the logical name when a specific minified source file should be used.">
    <p>
        <code>HasAssets</code> does not automatically prefer a minified file.
        The developer explicitly selects whether the regular or minified source
        file should be loaded.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block
                ->setStylesheets([
                'vendor/bootstrap.min',
                ])
                ->setScripts([
                'vendor/bootstrap.bundle.min',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="text" label="Resolved Paths">
        <x-slot:source>
            @verbatim
                resources/css/vendor/bootstrap.min.css
                resources/js/vendor/bootstrap.bundle.min.js
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        When regular source files are processed by Vite, the production Vite
        build can perform minification automatically. An explicit
        <code>.min</code> name is primarily useful when the source file is
        already distributed in minified form.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Adding Additional Assets"
    description="Repeated calls append newly resolved assets to the existing collections.">
    <p>
        Calling <code>setStylesheets()</code> or <code>setScripts()</code>
        does not remove assets that were previously attached. Newly resolved
        assets are appended to the applicable collection.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setStylesheets([
                'blocks/hero-banner',
                ]);

                $block->setStylesheets([
                'components/status-card',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getStylesheets();

                // [
                //     'resources/css/blocks/hero-banner.css',
                //     'resources/css/components/status-card.css',
                // ]
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Duplicate Assets"
    description="Resolved asset paths are stored only once.">
    <p>
        Duplicate paths are removed automatically. Attaching the same logical
        asset multiple times does not cause the resulting Vite entry point to
        appear multiple times.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setStylesheets([
                'blocks/hero-banner',
                'blocks/hero-banner',
                ]);

                $block->setStylesheets([
                'blocks/hero-banner.css',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getStylesheets();

                // [
                //     'resources/css/blocks/hero-banner.css',
                // ]
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Clearing Assets"
    description="Remove all attached stylesheets or scripts from the object.">
    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block
                ->setStylesheets([
                'blocks/hero-banner',
                ])
                ->setScripts([
                'blocks/hero-banner',
                ]);

                $block->clearStylesheets();
                $block->clearScripts();
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getStylesheets();

                // []

                $block->getScripts();

                // []
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Available Methods"
    description="HasAssets adds methods for managing stylesheet and script entry points.">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Method</th>
                <th scope="col">Returns</th>
                <th scope="col">Description</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th scope="row">
                    <code>getStylesheets()</code>
                </th>

                <td>
                    <code>array</code>
                </td>

                <td>
                    Returns the resolved Vite stylesheet entry points attached
                    to the object.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setStylesheets(array $stylesheets = [])</code>
                </th>

                <td>
                    <code>static</code>
                </td>

                <td>
                    Resolves and attaches one or more logical stylesheet names.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>clearStylesheets()</code>
                </th>

                <td>
                    <code>static</code>
                </td>

                <td>
                    Removes all attached stylesheet entry points.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>getScripts()</code>
                </th>

                <td>
                    <code>array</code>
                </td>

                <td>
                    Returns the resolved Vite script entry points attached to
                    the object.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setScripts(array $scripts = [])</code>
                </th>

                <td>
                    <code>static</code>
                </td>

                <td>
                    Resolves and attaches one or more logical script names.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>clearScripts()</code>
                </th>

                <td>
                    <code>static</code>
                </td>

                <td>
                    Removes all attached script entry points.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Fluent Configuration"
    description="Asset methods can be combined with methods provided by other PixiiBomb traits.">
    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block = (new Block())
                ->setAlias('Hero Banner')
                ->setView('blocks.hero-banner')
                ->setStylesheets([
                'blocks/hero-banner',
                'pixii::components/code-example',
                ])
                ->setScripts([
                'blocks/hero-banner',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        In this example, <code>setAlias()</code> comes from
        <code>HasAlias</code>, <code>setView()</code> comes from
        <code>HasView</code>, and the asset methods come from
        <code>HasAssets</code>.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Important Behavior"
    description="HasAssets stores resolved Vite entry points rather than rendering HTML asset tags.">
    <p>
        <code>HasAssets</code> does not directly render
        <code>&lt;link&gt;</code> or <code>&lt;script&gt;</code> elements. It
        stores resolved Vite entry points for a template or layout to pass to
        Laravel's <code>@vite</code> directive.
    </p>

    <p>
        Assets are resolved when <code>setStylesheets()</code> or
        <code>setScripts()</code> is called. If a requested file cannot be
        located, the asset manager logs a warning and omits it from the
        resulting collection.
    </p>

    <p>
        If the same namespaced asset exists in multiple registered PixiiBomb
        package resource directories, the asset is considered ambiguous and
        cannot be resolved automatically. PixiiBomb packages should therefore
        use unique logical paths for package assets.
    </p>

    <p>
        In production, attached assets must be included in the application's
        Vite build so that Laravel can locate their generated entries in the
        Vite manifest.
    </p>
</x-pixii::doc-section>
