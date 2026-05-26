<?php

namespace PixiiBomb\Core\Traits;

trait HasAttributes
{
    protected ?string $id = null;

    protected bool $disabled = false;
    protected array $attributes = [];

    public function getId(): ?string { return $this->id; }

    public function getDisabled(): bool { return $this->disabled; }
    public function getAttributes(): array { return $this->attributes; }
    public function getAttribute(string $key): string|bool|null { return $this->attributes[$key] ?? null; }

    public function setId(string $id): self
    {
        $this->id = $id;
        $this->attributes['id'] = $id;

        return $this;
    }

    public function setClass(string $class): self
    {
        $this->attributes['class'] = $class;

        return $this;
    }

    public function addClass(string $class): self
    {
        $current = $this->attributes['class'] ?? '';

        $this->attributes['class'] = trim("{$current} {$class}");

        return $this;
    }

    public function setDisabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;
        $this->setAttribute('disabled', $disabled);

        return $this;
    }

    public function setAttribute(string $key, string|bool|null $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

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

    public function renderAttributeValue(string $key): string
    {
        $value = $this->getAttribute($key);

        return is_string($value) ? e($value) : '';
    }
}
