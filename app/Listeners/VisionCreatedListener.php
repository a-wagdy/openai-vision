<?php

namespace App\Listeners;

use App\Events\VisionCreated;
use App\Integrations\OpenAI\OpenAIApi;
use App\Integrations\OpenAI\OpenAIClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class VisionCreatedListener implements ShouldQueue
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

        $vision = $event->vision;

        $openAIApi = new OpenAIApi(new OpenAIClient());

        $response = $openAIApi->identifyImage($vision->getImageBase64());

        $responseBody = $response->getBody()->getContents();

        $vision->update(['response' => json_decode($responseBody, true)]);
    }


}
