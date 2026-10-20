<div class="section-header">
    <div class="section-title">CORE TRAITS</div>

    <h1>HasAttributes</h1>

    <p class="lead">
        Assign and safely render HTML attributes for a PixiiBomb component.
    </p>

    <p>
        <strong>Namespace:</strong>
        <code>PixiiBomb\Core\Traits\HasAttributes</code>
    </p>
</div>

<x-pixii::doc-section
    title="Overview"
    description="Manage common and custom HTML attributes through a fluent interface.">

    <p>
        The <code>HasAttributes</code> trait adds support for an element ID,
        CSS classes, a disabled state, and arbitrary custom HTML attributes.
    </p>

    <p>
        Attributes are stored in a keyed collection and can be retrieved
        individually or rendered together as an escaped HTML attribute string.
        Boolean, null, and string values are handled according to their
        appropriate HTML behavior.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Basic Usage"
    description="Assign common HTML attributes through fluent configuration methods.">

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                use PixiiBomb\Core\Data\ComponentBlock;

                $block = (new ComponentBlock())
                ->setId('primary-action')
                ->setClass('btn btn-primary')
                ->setAttribute('aria-label', 'Continue')
                ->setDisabled();
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Attribute methods return the current object, allowing them to be
        combined in a fluent configuration chain.
    </p>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->renderAttributes();

                // id="primary-action" class="btn btn-primary"
                // aria-label="Continue" disabled
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Element ID"
    description="Assign an element ID and synchronize it with the rendered attribute collection.">

    <p>
        The <code>setId()</code> method assigns the component's dedicated
        <code>id</code> property and adds the same value to the rendered
        attributes collection.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setId('hero-banner');

                $block->getId();

                // hero-banner

                $block->getAttribute('id');

                // hero-banner
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Use <code>setId()</code> when assigning an ID so that
        <code>getId()</code> and the rendered <code>id</code> attribute remain
        synchronized.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="CSS Classes"
    description="Replace or append values in the class attribute.">

    <p>
        Use <code>setClass()</code> to replace the complete class attribute.
        Use <code>addClass()</code> to append one or more classes to its
        existing value.
    </p>

    <x-pixii::code-example language="php" label="Replacing Classes">
        <x-slot:source>
            @verbatim
                $block->setClass('btn btn-primary');

                $block->getAttribute('class');

                // btn btn-primary
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Appending Classes">
        <x-slot:source>
            @verbatim
                $block
                ->setClass('btn')
                ->addClass('btn-primary shadow');

                $block->getAttribute('class');

                // btn btn-primary shadow
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Multiple classes can be passed to either method as a
        space-delimited string. <code>addClass()</code> trims the resulting
        string but does not remove duplicate class names.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Disabled State"
    description="Synchronize the component's disabled state with its HTML attributes.">

    <p>
        Calling <code>setDisabled()</code> without an argument disables the
        component. The dedicated disabled property and the rendered
        <code>disabled</code> attribute are updated together.
    </p>

    <x-pixii::code-example language="php" label="Disable">
        <x-slot:source>
            @verbatim
                $block->setDisabled();

                $block->getDisabled();

                // true

                $block->renderAttributes();

                // disabled
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Pass <code>false</code> to enable the component again. False boolean
        attributes remain in the internal collection but are omitted when the
        attributes are rendered.
    </p>

    <x-pixii::code-example language="php" label="Enable">
        <x-slot:source>
            @verbatim
                $block->setDisabled(false);

                $block->getDisabled();

                // false

                $block->renderAttributes();

                // ''
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Custom Attributes"
    description="Assign arbitrary string, boolean, or null HTML attribute values.">

    <p>
        Use <code>setAttribute()</code> to assign one custom attribute. The
        attribute name is used as the collection key.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block
                ->setAttribute('title', 'Open project')
                ->setAttribute('data-project-id', 'project-123')
                ->setAttribute('aria-expanded', 'false');
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->renderAttributes();

                // title="Open project" data-project-id="project-123"
                // aria-expanded="false"
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Multiple Attributes"
    description="Assign several attributes from one keyed array.">

    <p>
        The <code>setAttributes()</code> method accepts an associative array
        and passes every entry through <code>setAttribute()</code>.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setAttributes([
                'title' => 'Open project',
                'data-project-id' => 'project-123',
                'aria-current' => 'page',
                'hidden' => false,
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="php" label="Result">
        <x-slot:source>
            @verbatim
                $block->getAttributes();

                // [
                //     'title' => 'Open project',
                //     'data-project-id' => 'project-123',
                //     'aria-current' => 'page',
                //     'hidden' => false,
                // ]
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Attribute Values"
    description="Retrieve the complete attribute collection or one individual value.">

    <p>
        Use <code>getAttributes()</code> to retrieve the complete keyed
        collection. Use <code>getAttribute()</code> to retrieve one value by
        its attribute name.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setAttributes([
                'title' => 'Open project',
                'hidden' => false,
                ]);

                $block->getAttribute('title');

                // Open project

                $block->getAttribute('hidden');

                // false

                $block->getAttribute('missing');

                // null
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        A missing attribute returns <code>null</code>. Because null is also a
        supported stored value, <code>getAttribute()</code> does not distinguish
        between a missing key and a key explicitly assigned <code>null</code>.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Rendering Attributes"
    description="Convert the attribute collection into an escaped HTML attribute string.">

    <p>
        The <code>renderAttributes()</code> method converts stored attributes
        into a string suitable for inclusion in an HTML element.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setAttributes([
                'id' => 'save-button',
                'class' => 'btn btn-primary',
                'title' => 'Save & Continue',
                'disabled' => true,
                'hidden' => false,
                'data-value' => null,
                ]);

                $block->renderAttributes();

                // id="save-button" class="btn btn-primary"
                // title="Save &amp; Continue" disabled
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Value type</th>
                <th scope="col">Rendered behavior</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><code>string</code></td>
                <td>
                    Renders the escaped attribute name and quoted, escaped
                    value.
                </td>
            </tr>

            <tr>
                <td><code>true</code></td>
                <td>
                    Renders the escaped attribute name as an HTML boolean
                    attribute.
                </td>
            </tr>

            <tr>
                <td><code>false</code></td>
                <td>Omits the attribute.</td>
            </tr>

            <tr>
                <td><code>null</code></td>
                <td>Omits the attribute.</td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Rendering in Blade"
    description="Render the safely escaped attribute string without escaping it a second time.">

    <p>
        Because <code>renderAttributes()</code> escapes every rendered
        attribute name and value, its result can be emitted through Blade's raw
        output syntax.
    </p>

    <x-pixii::code-example language="blade" label="Blade">
        <x-slot:source>
            @verbatim
                <button {!! $block->renderAttributes() !!}>
                    Save
                </button>
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        Using Blade's escaped output syntax would escape the already-generated
        quotation marks and HTML entities a second time.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Excluding Attributes"
    description="Omit selected attributes when rendering the collection.">

    <p>
        Pass an array of attribute names to <code>renderAttributes()</code> to
        exclude them from the rendered result without removing them from the
        stored collection.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setAttributes([
                'id' => 'save-button',
                'class' => 'btn btn-primary',
                'data-action' => 'save',
                ]);

                $block->renderAttributes([
                'id',
                'class',
                ]);

                // data-action="save"
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Rendering a Single Value"
    description="Retrieve one escaped string attribute value without its name or quotation marks.">

    <p>
        The <code>renderAttributeValue()</code> method returns the escaped
        value of one string attribute. Boolean, null, and missing values return
        an empty string.
    </p>

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block->setAttribute('title', 'Save & Continue');

                $block->renderAttributeValue('title');

                // Save &amp; Continue
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <x-pixii::code-example language="blade" label="Blade">
        <x-slot:source>
            @verbatim
                <span title="{!! $block->renderAttributeValue('title') !!}">
                    Continue
                </span>
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Available Methods"
    description="HasAttributes adds methods for assigning, retrieving, and rendering HTML attributes.">

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
                <th scope="row"><code>getId()</code></th>
                <td><code>?string</code></td>
                <td>Returns the assigned element ID.</td>
            </tr>

            <tr>
                <th scope="row"><code>setId(string $id)</code></th>
                <td><code>self</code></td>
                <td>
                    Assigns the element ID and synchronizes the rendered
                    <code>id</code> attribute.
                </td>
            </tr>

            <tr>
                <th scope="row"><code>getDisabled()</code></th>
                <td><code>bool</code></td>
                <td>Returns the component's disabled state.</td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setDisabled(bool $disabled = true)</code>
                </th>
                <td><code>self</code></td>
                <td>
                    Updates the disabled state and synchronizes the rendered
                    <code>disabled</code> attribute.
                </td>
            </tr>

            <tr>
                <th scope="row"><code>getAttributes()</code></th>
                <td><code>array</code></td>
                <td>Returns the complete keyed attribute collection.</td>
            </tr>

            <tr>
                <th scope="row">
                    <code>getAttribute(string $key)</code>
                </th>
                <td><code>string|bool|null</code></td>
                <td>
                    Returns one attribute value, or <code>null</code> when it
                    does not exist.
                </td>
            </tr>

            <tr>
                <th scope="row"><code>setClass(string $class)</code></th>
                <td><code>self</code></td>
                <td>Replaces the complete CSS class attribute.</td>
            </tr>

            <tr>
                <th scope="row"><code>addClass(string $class)</code></th>
                <td><code>self</code></td>
                <td>Appends one or more CSS classes.</td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setAttribute(string $key, string|bool|null $value)</code>
                </th>
                <td><code>self</code></td>
                <td>Assigns one HTML attribute.</td>
            </tr>

            <tr>
                <th scope="row">
                    <code>setAttributes(array $attributes)</code>
                </th>
                <td><code>self</code></td>
                <td>Assigns multiple HTML attributes.</td>
            </tr>

            <tr>
                <th scope="row">
                    <code>renderAttributes(array $except = [])</code>
                </th>
                <td><code>string</code></td>
                <td>
                    Returns the escaped HTML attribute string while optionally
                    excluding selected attributes.
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <code>renderAttributeValue(string $key)</code>
                </th>
                <td><code>string</code></td>
                <td>
                    Returns one escaped string attribute value, or an empty
                    string for a non-string value.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Fluent Configuration"
    description="Attribute methods can be combined with methods provided by other PixiiBomb traits.">

    <x-pixii::code-example language="php" label="PHP">
        <x-slot:source>
            @verbatim
                $block = (new ComponentBlock())
                ->setAlias('Primary Action')
                ->setComponent('pixii::button')
                ->setId('primary-action')
                ->setClass('btn btn-primary')
                ->setAttributes([
                'aria-label' => 'Continue',
                'data-action' => 'continue',
                ]);
            @endverbatim
        </x-slot:source>
    </x-pixii::code-example>

    <p>
        In this example, the alias and component methods are supplied by other
        PixiiBomb traits, while the ID, class, and custom attribute methods come
        from <code>HasAttributes</code>.
    </p>
</x-pixii::doc-section>

<x-pixii::doc-section
    title="Important Behavior"
    description="Dedicated properties are synchronized only through their corresponding setter methods.">

    <p>
        Use <code>setId()</code> rather than
        <code>setAttribute('id', ...)</code> when assigning an element ID.
        Assigning the attribute directly updates the rendered collection but
        does not update the dedicated value returned by <code>getId()</code>.
    </p>

    <p>
        Likewise, use <code>setDisabled()</code> when updating the disabled
        state. Assigning <code>disabled</code> through
        <code>setAttribute()</code> or <code>setAttributes()</code> does not
        update the dedicated value returned by <code>getDisabled()</code>.
    </p>

    <p>
        Attribute names and string values are escaped during rendering.
        Attributes assigned <code>null</code> or <code>false</code> remain in
        the internal collection but are omitted from the rendered string.
    </p>

    <p>
        The trait does not validate whether custom attribute names or values
        are appropriate for a particular HTML element. The consuming component
        remains responsible for assigning semantically valid attributes.
    </p>
</x-pixii::doc-section>
