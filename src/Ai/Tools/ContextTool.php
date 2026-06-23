<?php

namespace PixiiBomb\Core\Ai\Tools;

use Laravel\Ai\Contracts\Tool;
use PixiiBomb\Core\Ai\Support\AgentRuntime;

abstract class ContextTool implements Tool
{
    public function __construct(protected AgentRuntime $runtime)
    {
    }
}
