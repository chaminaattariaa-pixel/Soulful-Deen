<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->model  = config('services.openai.model', 'gpt-4o-mini');
    }

    /**
     * Send a chat completion request to OpenAI.
     *
     * @param array $messages e.g. [['role'=>'system','content'=>'...'], ['role'=>'user','content'=>'...']]
     * @return string|null
     */
    public function queryChat(array $messages): ?string
    {
        if (empty($this->apiKey)) {
            Log::error('OpenAIService: missing API key (set OPENAI_API_KEY in .env)');
            return null;
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post($this->baseUrl, [
                    'model' => $this->model,
                    'messages' => $messages,
                    'temperature' => 0.6,
                    'max_tokens' => 700,
                ]);

            if ($response->failed()) {
                Log::error('OpenAIService request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return null;
            }

            $data = $response->json();

            return $data['choices'][0]['message']['content'] ?? null;

        } catch (\Throwable $e) {
            Log::error('OpenAIService exception: ' . $e->getMessage());
            return null;
        }
    }
}