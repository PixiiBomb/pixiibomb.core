<?php

namespace PixiiBomb\Core\Support;

use Illuminate\Console\Command;
use PixiiBomb\Core\Enums\ConsoleColors;
use Symfony\Component\Console\Helper\ProgressBar;

class PixiiLog
{
    public function __construct(protected Command $command)
    {
    }

    public function banner(): void
    {
        $this->newLine();
        $this->primary(' ____  _      _ _ ____                  _     ');
        $this->primary('|  _ \(_)_  _(_|_) __ )  ___  _ __ ___ | |__  ');
        $this->primary('| |_) | \ \/ / | |  _ \ / _ \| \'_ ` _ \| \'_ \ ');
        $this->primary('|  __/| |>  <| | | |_) | (_) | | | | | | |_) |');
        $this->primary('|_|   |_/_/\_\_|_|____/ \___/|_| |_| |_|_.__/ ');
        $this->secondary('        🧚‍♀️ Magical Laravel Installer 💣');
        $this->newLine();
    }

    public function getProgressBar(int $max): ProgressBar
    {
        $progress = $this->command->getOutput()->createProgressBar($max);

        $progress->setBarCharacter($this->color('█', ConsoleColors::PRIMARY->value));
        $progress->setEmptyBarCharacter($this->color('░', ConsoleColors::PROGRESS_BAR_BACKGROUND->value));
        $progress->setProgressCharacter('🧚‍♀️');

        return $progress;
    }

    public function section(string $text): void
    {
        $this->primary(" ℹ️ | {$text}");
    }

    public function primary(string $text): void
    {
        $this->writeLine($text, ConsoleColors::PRIMARY->value);
    }

    public function secondary(string $text): void
    {
        $this->writeLine($text, ConsoleColors::SECONDARY->value);
    }

    public function success(string $text): void
    {
        $this->writeLine("✅ {$text}", ConsoleColors::SUCCESS->value);
    }

    public function warning(string $text): void
    {
        $this->writeLine($text, ConsoleColors::WARNING->value);
    }

    public function caution(string $text): void
    {
        $this->writeLine($text, ConsoleColors::CAUTION->value);
    }

    public function info(string $text): void
    {
        $this->writeLine($text, ConsoleColors::INFO->value);
    }

    public function error(string $text): void
    {
        $this->command->error($text);
    }

    public function line(string $text): void
    {
        $this->command->line($text);
    }

    public function newLine(int $count = 1): void
    {
        $this->command->newLine($count);
    }

    public function writeLine(string $text, ?string $color = ConsoleColors::TEXT->value): void
    {
        $this->command->line('    '.$this->color($text, $color));
    }

    public function color(string $text, string $color): string
    {
        return sprintf("\033[%sm%s\033[0m", $color, $text);
    }

    public function padded(string $text = '', int $level = 1): void
    {
        $this->command->line(str_repeat(' ', $level * 4).$text);
    }

    public function paddedColor(string $text, string $color, int $level = 3): void
    {
        $this->command->line(str_repeat(' ', $level).$this->color($text, $color));
    }

    public function divider(string $title, ?string $icon = null, int $width = 68): void
    {
        $label = trim(($icon ? "{$icon} " : '').$title);
        $line = '─ '. $label.' ';

        $this->paddedColor(
            $line.str_repeat('─', max(0, $width - mb_strlen($line))),
            ConsoleColors::PRIMARY->value
        );
    }

    public function task(string $status, string $description, int $level = 2): void
    {
        $this->padded("├─ [{$status}] {$description}", $level);
    }

    public function step(string $text): void
    {
        $this->paddedColor("› {$text}", ConsoleColors::TEXT->value, 2);
    }

    public function done(string $text): void
    {
        $this->paddedColor("✓ {$text}", ConsoleColors::SUCCESS->value, 2);
    }
}
