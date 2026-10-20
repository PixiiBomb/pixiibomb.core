<?php

namespace PixiiBomb\Core\Traits;

use Illuminate\Support\Str;

trait HasComponent
{
    protected ?string $componentName = null;
    protected array $parameters = [];

    public function getComponentName(): ?string
    {
        return $this->componentName;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setComponent(string $componentName, array $parameters = []): self
    {
        $this->componentName = Str::kebab($componentName);
        $this->parameters = $parameters;

        return $this;
    }

    public function setComponentName(?string $componentName): self
    {
        $this->componentName = $componentName === null
            ? null
            : Str::kebab($componentName);

        return $this;
    }

    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }
}
