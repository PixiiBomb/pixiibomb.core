<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $conversationsTable = config('ai.conversations.tables.conversations', 'agent_conversations');
        $messagesTable = config('ai.conversations.tables.messages', 'agent_conversation_messages');

        Schema::table($conversationsTable, function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        Schema::table($messagesTable, function (Blueprint $table) use ($conversationsTable) {
            $table->foreign('conversation_id')
                ->references('id')
                ->on($conversationsTable)
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        $conversationsTable = config('ai.conversations.tables.conversations', 'agent_conversations');
        $messagesTable = config('ai.conversations.tables.messages', 'agent_conversation_messages');

        Schema::table($messagesTable, function (Blueprint $table) {
            $table->dropForeign(['conversation_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table($conversationsTable, function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
