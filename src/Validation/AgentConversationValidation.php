<?php

namespace PixiiBomb\Core\Validation;

use PixiiBomb\Core\Enums\Action;

class AgentConversationValidation extends ResourceValidation
{
    protected static function fields(): array
    {
        return [
            'user_id' => ['integer', 'exists:users,id'],
            'title' => ['string', 'max:255'],
        ];
    }

    protected static function requiredFor(Action $action): array
    {
        return match ($action) {
            Action::CREATE, Action::UPDATE => ['title'],
            default => [],
        };
    }
}
