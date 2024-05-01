<?php

declare(strict_types=1);

namespace App\Integrations\OpenAI;

readonly class OpenAIApi
{
    public function __construct(private OpenAIClient $client)
    {
    }

    public function test()
    {
        $payload = [
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0.7,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Say this is a test!'
               ]
            ]
        ];

        return $this->client->post(
            'completions',
            [
                'json' => $payload,
            ]
        );
    }
}