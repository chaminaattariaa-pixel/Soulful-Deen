<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    protected GeminiService $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    public function index()
    {
        return view('chatbot');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'lang'    => 'required|in:en,ur',
        ]);

        $user    = $request->user();
        $message = $request->message;
        $lang    = $request->lang;

        ChatMessage::create([
            'user_id' => $user?->id,
            'role'    => 'user',
            'message' => $message,
            'lang'    => $lang,
        ]);

        $languageInstruction = $lang === 'ur'
            ? 'Respond in Urdu.'
            : 'Respond in English.';

        $systemPrompt = "You are Soulful Deen, an Islamic guidance assistant. "
            . "Give authentic, respectful answers grounded in the Quran and authentic Hadith. "
            . "Cite the specific Surah/Ayah or Hadith source when you reference one. "
            . "Avoid issuing personal fatwas on complex fiqh matters — instead explain the general "
            . "scholarly view and advise the user to consult a qualified local scholar for their specific situation. "
            . $languageInstruction;

        $reply = $this->gemini->queryChat($systemPrompt, $message)
            ?? 'Sorry, I could not reach the AI service right now. Please try again shortly.';

        ChatMessage::create([
            'user_id' => $user?->id,
            'role'    => 'assistant',
            'message' => $reply,
            'lang'    => $lang,
        ]);

        return response()->json(['reply' => $reply]);
    }
}