<?php

namespace PixiiBomb\Core\Data;

/**
 * Represents a named section within the application.
 *
 * Sections are used to organize related content or functionality under a
 * common identifier.
 */
class SectionDirective
{
    /**
     * The name of the section.
     */
    protected string $name = '';

    /**
     * Creates a new section.
     *
     * @param string $name The section name.
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * Gets the section name.
     *
     * @return string The section name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the section name.
     *
     * @param string $name The section name.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
