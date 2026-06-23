<?php

namespace PixiiBomb\Core\Controllers\Api;

use PixiiBomb\Core\Ai\Support\AgentContext;
use App\Ai\Agents\{CreativeAgent, StructuredAgent};
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use PixiiBomb\Core\Ai\Agents\ChatbotAgent;
use PixiiBomb\Core\Ai\Support\AgentRuntime;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChatbotEndpointsController extends Controller
{
    protected null|string $provider = null;
    protected null|string $model = null;

    public function __construct()
    {
        $this->provider = $this->provider();
    }

    public function provider(): string
    {
        return config('ai.default');
    }

    public function model(): string
    {
        return app()->environment('local')
            ? config('settings.openai.dev_model')
            : config('settings.openai.prod_model');
    }

    public function chat(Request $request): JsonResponse|StreamedResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'timezone' => 'nullable|string',
            'conversation_id' => 'nullable|string',
        ]);

        $user = $request->user();
        $message = $request->input('message');
        $conversationId = $request->input('conversation_id');

        $runtime = new AgentRuntime(context: AgentContext::fromRequest($request));
        $provider = $this->provider();
        $model = $this->model();

        $agent = ChatbotAgent::make(runtime: $runtime);

        if (! $conversationId) {
            $response = $agent
                ->forUser($user)
                ->prompt(
                    prompt: $message,
                    provider: $provider,
                    model: $model,
                    timeout: 60,
                );

            return response()->json([
                'type' => 'conversation_created',
                'conversation_id' => $response->conversationId,
                'prompt' => $message,
                'response' => (string) $response,
            ]);
        }

        $agent = $agent->continue($conversationId, as: $user);

        return response()->stream(function () use ($agent, $message, $provider, $model, $conversationId) {
            echo json_encode([
                    'type' => 'conversation',
                    'conversation_id' => $conversationId,
                ]) . "\n";

            if (ob_get_level() > 0) {
                ob_flush();
            }

            flush();

            $stream = $agent->stream(
                prompt: $message,
                provider: $provider,
                model: $model,
                timeout: 60,
            );

            foreach ($stream as $chunk) {
                $event = json_decode((string) $chunk, true);

                if (! is_array($event)) {
                    continue;
                }

                if (($event['type'] ?? null) !== 'text_delta') {
                    continue;
                }

                $delta = $event['delta'] ?? '';

                if ($delta === '') {
                    continue;
                }

                echo json_encode([
                        'type' => 'text_delta',
                        'delta' => $delta,
                        'conversation_id' => $conversationId,
                    ]) . "\n";

                if (ob_get_level() > 0) {
                    ob_flush();
                }

                flush();
            }
        }, 200, [
            'Content-Type' => 'application/x-ndjson; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-transform',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    public function sentiment(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');
        $response = StructuredAgent::make()->prompt($message);

        return response()->json([
            'prompt' => $message,
            'raw' => $response,
        ]);
    }

    public function author(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'genre' => 'required|string|max:50',
        ]);

        $message = $request->input('message');
        $genre = $request->input('genre', 'general');
        $response = CreativeAgent::make()->prompt($message);

        return response()->json([
            'prompt' => $message,
            'genre' => $genre,
            'raw' => $response,
            'response' => (string) $response,
        ]);
    }
}
