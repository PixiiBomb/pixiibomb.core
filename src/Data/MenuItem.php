<?php

namespace PixiiBomb\Core\Data;

/**
 * Represents a navigable menu item.
 *
 * A menu item defines a single entry within a navigation menu, including its
 * display label, destination route, optional icon, active state, and any
 * contextual action groups associated with it.
 */
class MenuItem extends ComponentBlock
{
    /**
     * The optional icon displayed alongside the menu item.
     */
    protected ?string $icon = null;

    /**
     * The display label for the menu item.
     */
    protected string $label = '';

    /**
     * The route or URL the menu item navigates to.
     */
    protected string $route = '';

    /**
     * Indicates whether this menu item is currently active.
     */
    protected bool $isActive = false;

    /**
     * The contextual action groups associated with this menu item.
     *
     * @var MenuGroup[]
     */
    protected array $actions = [];

    /**
     * Creates a new menu item.
     *
     * @param string      $label The display label.
     * @param string      $route The destination route or URL.
     * @param string|null $icon  The optional icon identifier.
     */
    public function __construct(string $label, string $route = '#', ?string $icon = null)
    {
        $this->setLabel($label);
        $this->setRoute($route);
        $this->setIcon($icon);

        parent::__construct();
    }

    /**
     * Gets the icon associated with the menu item.
     *
     * @return string|null The icon identifier, or null if no icon is assigned.
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Gets the display label.
     *
     * @return string The menu item label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Gets the destination route or URL.
     *
     * @return string The menu item's route.
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * Determines whether the menu item is active.
     *
     * @return bool True if the item is active; otherwise, false.
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Gets the contextual action groups for the menu item.
     *
     * @return MenuGroup[] The collection of action groups.
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Sets the icon displayed with the menu item.
     *
     * @param string|null $icon The icon identifier, or null to remove the icon.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Sets the display label.
     *
     * @param string $label The menu item label.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Sets the destination route or URL.
     *
     * @param string $route The route or URL.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Sets whether the menu item is currently active.
     *
     * @param bool $isActive True to mark the item as active; otherwise, false.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Sets the contextual action groups for the menu item.
     *
     * Only instances of {@see MenuGroup} are retained. Any other values are
     * discarded.
     *
     * @param MenuGroup[] $actions The action groups to associate with the menu item.
     *
     * @return self Returns the current instance for method chaining.
     */
    public function setActions(array $actions): self
    {
        $this->actions = collect($actions)
            ->filter(fn ($item) => $item instanceof MenuGroup)
            ->values()
            ->all();

        return $this;
    }

    /**
     * Gets the style enumeration associated with this component.
     *
     * @return string
     */
    protected static function getStyleEnum(): string
    {
        return true;
    }
}
