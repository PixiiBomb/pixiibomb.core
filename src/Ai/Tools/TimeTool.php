<?php

namespace PixiiBomb\Core\Ai\Tools;

use Carbon\Carbon;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Tools\Request;
use Stringable;

class TimeTool extends ContextTool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Get the current date and time. If the user does not specify a timezone, call this tool without a timezone and it will use the current AgentContext timezone.';
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'timezone' => $schema->string()
                ->description('The timezone for which to get the current date and time. (e.g., America/New_York, Europe/London)')
        ];
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $context = $this->runtime->context;

        if (! empty($request['timezone'])) {
            $timezone = $request['timezone'];
            $timezoneSource = 'tool_argument';
        } elseif (! empty($context->timezone)) {
            $timezone = $context->timezone;
            $timezoneSource = 'agent_context';
        } elseif (! empty($context->user?->timezone)) {
            $timezone = $context->user->timezone;
            $timezoneSource = 'user_profile';
        } else {
            $timezone = config('app.timezone');
            $timezoneSource = 'app_config';
        }

        try {
            $now = Carbon::now($timezone);

            return json_encode([
                'timezone' => $timezone,
                'timezone_source' => $timezoneSource,
                'datetime' => $now->toDateTimeString(),
                'time' => $now->format('g:i A'),
                'day_of_week' => $now->format('l'),
                'utc' => $now->format('P'),
            ]);
        } catch (\Exception $e) {
            return "Error invalid timezone: {$timezone}. {$e->getMessage()}";
        }
    }
}
