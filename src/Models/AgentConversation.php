<?php

namespace PixiiBomb\Core\Models;

use App\Models\AgentConversationMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgentConversation extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'title',
    ];

    public function getTable(): string
    {
        return config('ai.conversations.tables.conversations', 'agent_conversations');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(
            AgentConversationMessage::class,
            'conversation_id',
            'id'
        );
    }
}
