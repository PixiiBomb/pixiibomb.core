<?php

namespace PixiiBomb\Core\Ai\Support;

use App\Models\User;
use Illuminate\Http\Request;

readonly class AgentContext
{
    public function __construct(public ?User $user = null, public ?string $timezone = null, public ?string $locale = null, public ?string $ip = null)
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            user: $request->user(),
            timezone: $request->input('timezone'),
            locale: $request->input('locale'),
            ip: $request->ip(),
        );
    }
}
