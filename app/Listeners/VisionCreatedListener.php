<?php

namespace App\Listeners;

use App\Events\VisionCreated;
use App\Integrations\OpenAI\OpenAIApi;
use App\Integrations\OpenAI\OpenAIClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class VisionCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VisionCreated $event): void
    {
        Log::info('reached listener');

        $response = [
            "id" => "chatcmpl-9KPm87eG0sepzHJR5CkRzPoaY1w4W",
            "object" => "chat.completion",
            "created" => 1714652668,
            "model" => "gpt-4-turbo-2024-04-09",
            "choices" => [
                [
                    "index" => 0,
                    "message" => [
                        "role" => "assistant",
                        "content" => "The image shows an orange in three different forms: one whole orange, one half sliced orange exposing the interior segments, and one peeled segment of the orange."
                    ],
                    "logprobs" => null,
                    "finish_reason" => "stop"
                ]
            ],
            "usage" => [
                "prompt_tokens" => 1118,
                "completion_tokens" => 51,
                "total_tokens" => 1169
            ],
            "system_fingerprint" => "fp_5d12056990"
        ];

        $vision = $event->vision;
        $base64_image = $vision->getImageBase64();

        $api = new OpenAIApi(new OpenAIClient());

        $response = $api->identifyImage($base64_image);

        $responseBody = $response->getBody()->getContents();

        $response = json_decode($responseBody, true);

        $vision->update(['response' => json_encode($response)]);
    }


}
