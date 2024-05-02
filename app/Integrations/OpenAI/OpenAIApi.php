<?php

declare(strict_types=1);

namespace App\Integrations\OpenAI;

readonly class OpenAIApi
{
    public function __construct(private OpenAIClient $client)
    {
    }

    public function identifyImage(string $base64_image)
    {
        $requestPayload = [
            'model' => 'gpt-4-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'What’s in this image?',
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => 'data:image/jpeg;base64,' . $base64_image
                            ],
                        ],
                    ],
                ],
            ],
            'max_tokens' => 300,
        ];

        return $this->client->post(
            'chat/completions',
            [
                'json' => $requestPayload,
            ]
        );
    }
}