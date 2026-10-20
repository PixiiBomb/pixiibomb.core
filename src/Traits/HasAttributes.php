<?php

namespace PixiiBomb\Core\Traits;

use PixiiBomb\Core\Data\ComponentBlock;

/**
 * Provides HTML attribute support for a component.
 *
 * This trait manages common HTML attributes such as the element ID, CSS
 * classes, disabled state, and arbitrary custom attributes. It also provides
 * helper methods for rendering attributes safely into HTML.
 */
trait HasAttributes
{
    /**
     * The HTML ID assigned to the component.
     */
    protected ?string $id = null;

    /**
     * Indicates whether the component is disabled.
     */
    protected bool $disabled = false;

    /**
     * The collection of HTML attributes.
     *
     * @var array<string, string|bool|null>
     */
    protected array $attributes = [];

    protected array $classes = [];

    /**
     * Gets the HTML ID.
     *
     * @return string|null The element ID, or null if one has not been assigned.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Determines whether the component is disabled.
     *
     * @return bool True if the component is disabled; otherwise, false.
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Gets all HTML attributes.
     *
     * @return array<string, string|bool|null> The component's attributes.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Gets a single HTML attribute.
     *
     * @param string $key The attribute name.
     *
     * @return string|bool|null The attribute value, or null if it does not exist.
     */
    public function getAttribute(string $key): string|bool|null
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Sets the HTML ID.
     *
     * The ID is also synchronized to the rendered attributes collection.
     *
     * @param string $id The element ID.
     *
     * @return ComponentBlock|HasAttributes Returns the current instance for method chaining.
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        $this->attributes['id'] = $id;

        return $this;
    }

    /**
     * Sets the CSS class attribute.
     *
     * Any existing class value is replaced.
     *
     * @param string $class The CSS class string.
     *
     * @return ComponentBlock|HasAttributes Returns the current instance for method chaining.
     */
    public function setClass(string $class): self
    {
        $this->attributes['class'] = $class;

        return $this;
    }

    /**
     * Appends one or more CSS classes to the existing class attribute.
     *
     * @param string $class The CSS class or classes to append.
     *
     * @return ComponentBlock|HasAttributes Returns the current instance for method chaining.
     */
    public function addClass(string $class): self
    {
        $current = $this->attributes['class'] ?? '';

        $this->attributes['class'] = trim("{$current} {$class}");

        return $this;
    }

    /**
     * Sets whether the component is disabled.
     *
     * The disabled state is also synchronized to the rendered attributes
     * collection.
     *
     * @param bool $disabled True to disable the component; otherwise, false.
     *
     * @return ComponentBlock|HasAttributes Returns the current instance for method chaining.
     */
    public function setDisabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;
        $this->setAttribute('disabled', $disabled);

        return $this;
    }

    /**
     * Sets an individual HTML attribute.
     *
     * @param string $key The attribute name.
     * @param string|bool|null $value The attribute value.
     *
     * @return ComponentBlock|HasAttributes Returns the current instance for method chaining.
     */
    public function setAttribute(string $key, string|bool|null $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Sets multiple HTML attributes.
     *
     * @param array<string, string|bool|null> $attributes The attributes to assign.
     *
     * @return ComponentBlock|HasAttributes Returns the current instance for method chaining.
     */
    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Renders the component's HTML attributes.
     *
     * Attributes with null or false values are omitted. Boolean true values are
     * rendered as HTML boolean attributes.
     *
     * @param array<int, string> $except Attribute names to exclude.
     *
     * @return string The rendered HTML attribute string.
     */
    public function renderAttributes(array $except = []): string
    {
        return collect($this->attributes)
            ->except($except)
            ->filter(fn ($value) => $value !== null && $value !== false)
            ->map(function ($value, string $key) {
                if ($value === true) {
                    return e($key);
                }

                return e($key) . '="' . e((string) $value) . '"';
            })
            ->implode(' ');
    }

    /**
     * Renders a single attribute value for use in HTML.
     *
     * @param string $key The attribute name.
     *
     * @return string The escaped attribute value, or an empty string if the
     *                attribute is not a string.
     */
    public function renderAttributeValue(string $key): string
    {
        $value = $this->getAttribute($key);

        return is_string($value) ? e($value) : '';
    }

    /**
     * Gets all CSS classes applied.
     *
     * @return string The complete CSS class string.
     */
    public function getClasses(): string
    {
        return collect($this->classes)
            ->filter(fn (?string $class) => filled($class))
            ->map(fn (string $class) => trim($class))
            ->implode(' ');
    }

    protected function defineClasses(): void
    {
    }
}
