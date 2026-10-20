<?php

namespace PixiiBomb\Core\Data;

/**
 * Represents a group of related menu items.
 *
 * Menu groups are typically used to organize navigation items under a shared
 * heading, such as "General", "Administration", or "Settings".
 */
class MenuGroup
{
    /**
     * The display label for the menu group.
     */
    protected string $label = '';

    /**
     * The menu items contained within this group.
     *
     * @var array
     */
    protected array $items = [];

    /**
     * Creates a new menu group.
     *
     * @param string $label The display label for the group.
     * @param array  $items The menu items contained within the group.
     */
    public function __construct(string $label, array $items = [])
    {
        $this->setLabel($label);
        $this->setItems($items);
    }

    /**
     * Gets the display label for the menu group.
     *
     * @return string The group label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Gets the menu items contained within this group.
     *
     * @return array The collection of menu items.
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Sets the display label for the menu group.
     *
     * @param string $label The group label.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Sets the menu items contained within this group.
     *
     * @param array $items The collection of menu items.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
