<div class="section-header">
    <div class="section-title">CORE TRAITS</div>

    <h1>HasComponent</h1>

    <p class="lead">
        Assign a normalized Blade component name and its parameters to a
        PixiiBomb object.
    </p>

    <p>
        <strong>Namespace:</strong>
        <code>PixiiBomb\Core\Traits\HasComponent</code>
    </p>
</div>

<x-pixii::doc-section
    title="Overview"
    description="Associate a Blade component and its parameters with a PixiiBomb object.">

    <p>
        The <code>HasComponent</code> trait adds an optional component name and
        a collection of parameters to a class. These values can be used by a
        template or layout to render a Laravel Blade component dynamically.
    </p>

    <p>
        Component names are normalized to kebab case when assigned.
        Parameters are stored as a keyed array and can be passed to the
        component as attributes or constructor values.
    </p>

    <p>
        The component name defaults to <code>null</code>, and the parameter
        collection defaults to an empty array.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Basic Usage"
    description="Assign a component and its parameters through the fluent setComponent() method.">

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                use PixiiBomb\Core\Data\Block;

                $block = (new Block())
                ->setComponent('pixii::hero-card', [
                'title' => 'Welcome to PixiiBomb',
                'description' => 'Art, technology, and whimsy.',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        The <code>setComponent()</code> method assigns both the component name
        and its complete parameter collection. It returns the current object
        for method chaining.
    </p>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getComponentName();

                // pixii::hero-card

                $block->getParameters();

                // [
                //     'title' => 'Welcome to PixiiBomb',
                //     'description' => 'Art, technology, and whimsy.',
                // ]
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Component Names"
    description="Component names are normalized to kebab case when assigned.">

    <p>
        Kebab-case normalization produces lowercase words separated by
        hyphens. This allows differently formatted component names to resolve
        to a consistent Blade component name.
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Assigned value</th>
                <th scope="col">Stored component name</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><code>Hero Card</code></td>
                <td><code>hero-card</code></td>
            </tr>

            <tr>
                <td><code>HeroCard</code></td>
                <td><code>hero-card</code></td>
            </tr>

            <tr>
                <td><code>hero_card</code></td>
                <td><code>hero-card</code></td>
            </tr>

            <tr>
                <td><code>hero-card</code></td>
                <td><code>hero-card</code></td>
            </tr>

            <tr>
                <td><code>pixii::HeroCard</code></td>
                <td><code>pixii::hero-card</code></td>
            </tr>
            </tbody>
        </table>
    </div>

    <x-pixii::code-example language="php" label="Normalization">
        <x-slot:source>
            @verbatim
                $block->setComponentName('pixii::PackageDetails');

                $block->getComponentName();

                // pixii::package-details
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Package Components"
    description="Use a Blade component namespace to reference a component supplied by a package.">

    <p>
        Laravel package components can be referenced through their registered
        Blade component namespace. PixiiBomb components use the
        <code>pixii::</code> prefix.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setComponent('pixii::code-example', [
                'language' => 'php',
                'label' => 'PHP',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Application components can be assigned without a package namespace.
    </p>

    <x-pixii::code-example language="php" label="Application Component">
        <x-slot:source>
            @verbatim
                $block->setComponent('dashboard-card', [
                'title' => 'Project Status',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Component Parameters"
    description="Pass values to the assigned Blade component through a keyed parameter collection.">

    <p>
        Component parameters are stored as an array. Each key represents the
        name of a value that will be supplied to the component.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setParameters([
                'title' => 'Project Status',
                'description' => 'Review the current project state.',
                'disabled' => false,
                'items' => [
                'Design',
                'Development',
                'Testing',
                ],
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getParameters();

                // [
                //     'title' => 'Project Status',
                //     'description' => 'Review the current project state.',
                //     'disabled' => false,
                //     'items' => [
                //         'Design',
                //         'Development',
                //         'Testing',
                //     ],
                // ]
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Replacing Parameters"
    description="setParameters() replaces the complete parameter collection.">

    <p>
        Calling <code>setParameters()</code> does not merge new values into
        the existing collection. The previously stored parameters are replaced
        by the supplied array.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setParameters([
                'title' => 'Original Title',
                'description' => 'Original description.',
                ]);

                $block->setParameters([
                'title' => 'Updated Title',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getParameters();

                // [
                //     'title' => 'Updated Title',
                // ]
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Replacing the Component"
    description="setComponent() replaces both the component name and its parameters.">

    <p>
        Each call to <code>setComponent()</code> assigns a new component name
        and replaces the complete parameter collection, including when the
        parameters argument is omitted.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setComponent('hero-card', [
                'title' => 'Welcome',
                ]);

                $block->setComponent('status-card');
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getComponentName();

                // status-card

                $block->getParameters();

                // []
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Removing a Component"
    description="Pass null to setComponentName() to remove the assigned component name.">

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setComponent('pixii::hero-card', [
                'title' => 'Welcome',
                ]);

                $block->setComponentName(null);

                $block->getComponentName();

                // null
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Removing the component name does not clear the parameter collection.
        Parameters can be cleared separately by passing an empty array to
        <code>setParameters()</code>.
    </p>

    <x-pixii::code-example language="php" label="Clear Parameters">
        <x-slot:source>
            @verbatim
                $block
                ->setComponentName(null)
                ->setParameters([]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Dynamic Component Rendering"
    description="Use the stored component name and parameters to render a Blade component dynamically.">

    <p>
        A template or layout can pass the stored values to Laravel's dynamic
        component implementation.
    </p>

    <x-pixii::code-example language="blade" label="Blade">
        <x-slot:source>
            @verbatim
                @if($block->getComponentName() !== null)
                    <x-dynamic-component
                        :component="$block->getComponentName()"
                        :attributes="$block->getParameters()"
                    />
                @endif
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        The component name determines which Blade component is rendered, while
        the parameter collection supplies its values.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Available Methods"
    description="HasComponent adds methods for assigning and retrieving a component and its parameters.">

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
                    <code>getComponentName()</code>
                </th>

                <td>
                    <code>?string</code>
                </td>

                <td>
                    Returns the normalized component name, or
                    <code>null</code> when no component has been assigned.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>getParameters()</code>
                </th>

                <td>
                    <code>array</code>
                </td>

                <td>
                    Returns the complete component parameter collection.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setComponent(string $componentName, array $parameters = [])</code>
                </th>

                <td>
                    <code>self</code>
                </td>

                <td>
                    Assigns and normalizes the component name and replaces its
                    parameter collection.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setComponentName(?string $componentName)</code>
                </th>

                <td>
                    <code>self</code>
                </td>

                <td>
                    Assigns and normalizes the component name. Passing
                    <code>null</code> removes the current component name
                    without changing its parameters.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setParameters(array $parameters)</code>
                </th>

                <td>
                    <code>self</code>
                </td>

                <td>
                    Replaces the complete component parameter collection.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Fluent Configuration"
    description="Component methods can be combined with methods provided by other PixiiBomb traits.">

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block = (new Block())
                ->setAlias('Hero Card')
                ->setComponent('pixii::hero-card', [
                'title' => 'Welcome to PixiiBomb',
                ])
                ->setStylesheets([
                'blocks/hero-card',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        In this example, <code>setAlias()</code> comes from
        <code>HasAlias</code>, the component methods come from
        <code>HasComponent</code>, and <code>setStylesheets()</code> comes
        from <code>HasAssets</code>.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Important Behavior"
    description="HasComponent stores component configuration but does not validate or render the component automatically.">

    <p>
        Assigning a component name does not confirm that the corresponding
        Blade component exists. Laravel will report an error when the template
        attempts to render an unknown component.
    </p>

    <p>
        Parameter names and values are not validated by the trait. The
        consuming component remains responsible for defining and validating
        the values it accepts.
    </p>

    <p>
        Calling <code>setComponentName()</code> changes only the component
        name. Calling <code>setParameters()</code> changes only the parameter
        collection. Use <code>setComponent()</code> when both values should be
        assigned together.
    </p>

    <p>
        Calling <code>setComponent()</code> without its optional parameters
        argument replaces any existing parameters with an empty array.
    </p>
</x-pixii::doc-section>
