<div class="section-header">
    <div class="section-title">CORE TRAITS</div>

    <h1>HasAlias</h1>

    <p class="lead">
        Assign an optional, normalized alias to a PixiiBomb object.
    </p>

    <p>
        <strong>Namespace:</strong>
        <code>PixiiBomb\Core\Traits\HasAlias</code>
    </p>
</div>

<x-pixii::doc-section
    title="Overview"
    description="Aliases provide an alternate identifier for an object."
>
    <p>
        The <code>HasAlias</code> trait adds an optional
        <code>alias</code> value to a class. An alias can be used as a
        template name, lookup key, user-defined reference, or any other
        alternate identifier needed by the consuming class.
    </p>

    <p>
        Aliases are optional and default to <code>null</code>. When an alias
        is assigned, it is normalized to kebab case so that differently
        formatted inputs produce a predictable result.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Basic Usage"
    description="Assign an alias through the fluent setAlias() method."
>
    <x-pixii::code-example
        language="php"
        label="PHP"
    >
        <x-slot:source>
            @verbatim
                use PixiiBomb\Core\Data\Block;

                $block = (new Block())
                ->setAlias('Hero Banner');

                $alias = $block->getAlias();
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        The call to <code>setAlias()</code> returns the current object, so it
        can be used as part of a fluent configuration chain.
    </p>

    <x-pixii::code-example
        language="php"
        label="Result"
    >
        <x-slot:source>
            @verbatim
                $block->getAlias();

                // hero-banner
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Alias Normalization"
    description="Aliases are converted to kebab case when they are assigned."
>
    <p>
        Kebab-case normalization produces lowercase words separated by
        hyphens. This makes aliases suitable for predictable lookup keys and
        other identifier-based operations.
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Assigned value</th>
                <th scope="col">Stored alias</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><code>Hero Banner</code></td>
                <td><code>hero-banner</code></td>
            </tr>

            <tr>
                <td><code>HeroBanner</code></td>
                <td><code>hero-banner</code></td>
            </tr>

            <tr>
                <td><code>hero_banner</code></td>
                <td><code>hero-banner</code></td>
            </tr>

            <tr>
                <td><code>hero-banner</code></td>
                <td><code>hero-banner</code></td>
            </tr>
            </tbody>
        </table>
    </div>

    <x-pixii::code-example
        language="php"
        label="Normalization"
    >
        <x-slot:source>
            @verbatim
                $block->setAlias('Main Navigation');

                $block->getAlias();

                // main-navigation
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Removing an Alias"
    description="Pass null to setAlias() to remove the current alias."
>
    <x-pixii::code-example
        language="php"
        label="PHP"
    >
        <x-slot:source>
            @verbatim
                $block->setAlias('Hero Banner');

                $block->setAlias(null);

                $block->getAlias();

                // null
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Available Methods"
    description="HasAlias adds methods for assigning and retrieving an alias."
>
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
                    <code>getAlias()</code>
                </th>

                <td>
                    <code>?string</code>
                </td>

                <td>
                    Returns the normalized alias, or <code>null</code> when
                    no alias has been assigned.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setAlias(?string $alias)</code>
                </th>

                <td>
                    <code>self</code>
                </td>

                <td>
                    Assigns and normalizes an alias. Passing
                    <code>null</code> removes the current alias.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Fluent Configuration"
    description="setAlias() can be combined with methods provided by other PixiiBomb traits."
>
    <x-pixii::code-example
        language="php"
        label="PHP"
    >
        <x-slot:source>
            @verbatim
                $block = (new Block())
                ->setAlias('Hero Banner')
                ->setView('blocks.hero-banner')
                ->setStylesheets([
                'blocks/hero-banner',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        In this example, <code>setAlias()</code> comes from
        <code>HasAlias</code>, <code>setView()</code> comes from
        <code>HasView</code>, and <code>setStylesheets()</code> comes from
        <code>HasAssets</code>.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Important Behavior"
    description="An alias is metadata and does not change an object's other properties automatically."
>
    <p>
        Assigning an alias does not modify the object's Blade view, HTML ID,
        CSS classes, or asset paths. It only stores a normalized alternate
        identifier.
    </p>

    <p>
        The trait also does not enforce uniqueness. If aliases are used as
        lookup keys, the collection or service performing that lookup is
        responsible for detecting duplicate aliases.
    </p>
</x-pixii::doc-section>
