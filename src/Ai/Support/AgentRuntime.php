<?php

namespace PixiiBomb\Core\Ai\Support;

use Laravel\Ai\Contracts\Tool;

readonly class AgentRuntime
{
    public function __construct(public AgentContext $context)
    {
    }

    public function tool(string $toolClass): Tool
    {
        return new $toolClass($this);
    }
}
