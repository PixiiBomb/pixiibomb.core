<?php

namespace PixiiBomb\Core\Validation;

use PixiiBomb\Core\Enums\Action;

class AgentConversationMessageValidation extends ResourceValidation
{
    protected static function fields(): array
    {
        $conversationsTable = config('ai.conversations.tables.conversations', 'agent_conversations');

        return [
            'conversation_id' => ['string', "exists:$conversationsTable,id"],
            'user_id' => ['integer', 'exists:users,id'],
            'agent' => ['string', 'max:255'],
            'role' => ['string', 'max:25'],
            'content' => ['string'],
            'attachments' => ['array'],
            'tool_calls' => ['array'],
            'tool_results' => ['array'],
            'usage' => ['array'],
            'meta' => ['array'],
        ];
    }

    protected static function requiredFor(Action $action): array
    {
        return match ($action) {
            Action::CREATE, Action::UPDATE => [
                'conversation_id',
                'agent',
                'role',
                'content',
            ],

            default => [],
        };
    }
}
