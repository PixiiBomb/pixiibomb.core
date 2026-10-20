<?php

namespace PixiiBomb\Core\Console\Commands;

use Illuminate\Console\Command;
use PixiiBomb\Core\Support\PixiiLog;

abstract class PixiiCommand extends Command
{
    protected PixiiLog $log;

    protected function bootPixiiLog(): void
    {
        $this->log = new PixiiLog($this);
    }
}
