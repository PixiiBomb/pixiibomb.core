<?php

namespace PixiiBomb\Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

class AiSetupController extends Controller
{
    /**
     * Health Check: Verify the API is running.
     *
     * This is a simple public endpoint to confirm the Laravel
     * application is up and responding to API requests.
     *
     * @return JsonResponse
     */
    public function healthCheck(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'Laravel AI Course API is running!',
            'laravel_version' => app()->version(),
        ]);
    }

    /**
     * Verify AI SDK Installation: Check that the AI SDK is properly installed and configured.
     *
     * This checks:
     * 1. The AI config file exists and is loaded
     * 2. The required database tables are present
     * 3. At least one AI provider API key is configured
     *
     * @return JsonResponse
     */
    public function verifyAiSdk(): JsonResponse
    {
        // -----------------------------------------------
        // Check 1: Is the AI config file loaded?
        // After publishing, config/ai.php should exist
        // and be accessible via config('ai').
        // -----------------------------------------------
        $aiConfigLoaded = !is_null(config('ai'));

        // -----------------------------------------------
        // Check 2: Do the AI SDK database tables exist?
        // The AI SDK creates two tables for conversation
        // storage when you run migrations.
        // -----------------------------------------------
        $conversationsTableExists = Schema::hasTable('agent_conversations');
        $messagesTableExists = Schema::hasTable('agent_conversation_messages');

        // -----------------------------------------------
        // Check 3: Are any provider API keys configured?
        // We check for the most common providers.
        // -----------------------------------------------
        $configuredProviders = collect([
            'openai' => !empty(config('ai.providers.openai.key')),
            'anthropic' => !empty(config('ai.providers.anthropic.key')),
            'gemini' => !empty(config('ai.providers.gemini.key')),
            'cohere' => !empty(config('ai.providers.cohere.key')),
            'mistral' => !empty(config('ai.providers.mistral.key')),
        ])->filter()->keys()->all();

        // -----------------------------------------------
        // Compile the verification report.
        // -----------------------------------------------
        $allChecksPass = $aiConfigLoaded
            && $conversationsTableExists
            && $messagesTableExists
            && count($configuredProviders) > 0;

        return response()->json([
            'status' => $allChecksPass ? 'ready' : 'incomplete',
            'checks' => [
                'ai_config_loaded' => $aiConfigLoaded,
                'conversations_table_exists' => $conversationsTableExists,
                'messages_table_exists' => $messagesTableExists,
                'configured_providers' => $configuredProviders,
            ],
            'message' => $allChecksPass
                ? 'AI SDK is fully set up and ready to go!'
                : 'Some checks failed. Review the details above.',
        ]);
    }
}
