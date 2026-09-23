<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        $this->model  = config('services.gemini.model', 'gemini-2.5-flash');
    }

    /**
     * Send a chat request to Gemini.
     *
     * @param string $systemPrompt Instructions describing the assistant's role/behavior
     * @param string $userMessage  The user's message
     * @return string|null
     */
    public function queryChat(string $systemPrompt, string $userMessage): ?string
    {
        if (empty($this->apiKey)) {
            Log::error('GeminiService: missing API key (set GEMINI_API_KEY in .env)');
            return null;
        }

        $url = "{$this->baseUrl}/{$this->model}:generateContent";

        try {
            $response = Http::withHeaders([
                    'x-goog-api-key' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->timeout(30)
                ->post($url, [
                    'system_instruction' => [
                        'parts' => [
                            ['text' => $systemPrompt],
                        ],
                    ],
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $userMessage],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.6,
                        'maxOutputTokens' => 2048,
                        'thinkingConfig' => ['thinkingBudget' => 0],
                    ],
                ]);

            if ($response->failed()) {
                Log::error('GeminiService request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                // Gemini returns 429 when the free-tier rate limit is hit
                if ($response->status() === 429) {
                    return 'The assistant is a bit busy right now (rate limit reached). Please try again in a moment.';
                }

                return null;
            }

            $data = $response->json();

            Log::info('Gemini finishReason: ' . ($data['candidates'][0]['finishReason'] ?? 'none'));

            return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        } catch (\Throwable $e) {
            Log::error('GeminiService exception: ' . $e->getMessage());
            return null;
        }
    }
}