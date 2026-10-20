<div class="section-header">
    <div class="section-title">GETTING STARTED</div>

    <h1>Traits</h1>

    <p class="lead">
        PixiiBomb traits provide reusable capabilities shared by Pages,
        Blocks, layouts, templates, and UI components.
    </p>
</div>

<x-pixii::doc-section
    title="Understanding Traits"
    description="Traits keep common behavior consistent across the PixiiBomb package ecosystem."
>
    <p>
        PixiiBomb objects are composed from small, focused traits. Each trait
        owns one capability, such as associating a Blade view, managing HTML
        attributes, or selecting a visual style.
    </p>

    <p>
        When a class uses a trait, the trait's public methods become part of
        that class's API. Classes also inherit traits used by their parent
        classes.
    </p>

    <x-pixii::code-example
        language="php"
        label="Inheritance"
    >
        <x-slot:source>
            @verbatim
                class Block
                {
                use HasAlias;
                use HasAssets;
                use HasView;
                }

                abstract class ComponentBlock extends Block
                {
                use HasAttributes;
                }

                class Button extends ComponentBlock
                {
                use HasStyle;
                use HasVariant;
                }
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Because <code>Button</code> extends <code>ComponentBlock</code>, which
        extends <code>Block</code>, it receives the capabilities from every
        level in this hierarchy.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Core Traits"
    description="Core traits provide capabilities used throughout every PixiiBomb package."
>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Trait</th>
                <th scope="col">Namespace</th>
                <th scope="col">Purpose</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th scope="row">
                    <code>HasAlias</code>
                </th>

                <td>
                    <code>PixiiBomb\Core\Traits\HasAlias</code>
                </td>

                <td>
                    Assigns an optional human-readable alias to an object.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>HasAssets</code>
                </th>

                <td>
                    <code>PixiiBomb\Core\Traits\HasAssets</code>
                </td>

                <td>
                    Associates stylesheets and scripts with a renderable
                    object.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>HasAttributes</code>
                </th>

                <td>
                    <code>PixiiBomb\Core\Traits\HasAttributes</code>
                </td>

                <td>
                    Manages IDs, CSS classes, disabled state, and arbitrary
                    HTML attributes.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>HasView</code>
                </th>

                <td>
                    <code>PixiiBomb\Core\Traits\HasView</code>
                </td>

                <td>
                    Associates a renderable object with its Blade view.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="UI Traits"
    description="UI traits provide capabilities specific to visual Blocks and components."
>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Trait</th>
                <th scope="col">Namespace</th>
                <th scope="col">Purpose</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th scope="row">
                    <code>HasStyle</code>
                </th>

                <td>
                    <code>PixiiBomb\Ui\Traits\HasStyle</code>
                </td>

                <td>
                    Assigns and validates a component's semantic style.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>HasVariant</code>
                </th>

                <td>
                    <code>PixiiBomb\Ui\Traits\HasVariant</code>
                </td>

                <td>
                    Assigns and validates a component's visual variant.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Traits in Block Documentation"
    description="Every Block page identifies the traits that contribute to its public API."
>
    <p>
        Block documentation includes both directly used and inherited traits.
        This makes it easier to determine which capabilities are available and
        where those capabilities are implemented.
    </p>

    <x-pixii::code-example
        language="text"
        label="Button API"
    >
        <x-slot:source>
            @verbatim
                Button
                ├── Block
                │   ├── HasAlias
                │   ├── HasAssets
                │   └── HasView
                ├── ComponentBlock
                │   └── HasAttributes
                └── Button
                ├── HasStyle
                └── HasVariant
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>
