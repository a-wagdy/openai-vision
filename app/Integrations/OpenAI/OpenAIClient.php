<?php

declare(strict_types=1);

namespace App\Integrations\OpenAI;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class OpenAIClient
{
    public const API_ENDPOINT = 'api.openai.com/v1/';

    /**
     * @var Client
     */
    private Client $client;

    /**
     *
     *
     * @throws Exception
     */
    public function __construct()
    {
        $apiKey = env('OPENAI_SECRET_KEY');

        if (!$apiKey) {
            throw new Exception('OpenAI key is required');
        }

        $config = [
            'timeout' => 30,
            'verify' => false,
            'base_uri' => 'https://' . self::API_ENDPOINT,
            'headers' => [
                'Authorization' => 'Bearer ' . 'sk-proj-Fqm6HMp3ltXczVaczwXRT3BlbkFJ3HA3MDmoBR7y4H6goq2A',
                'Content-Type' => 'application/json',
            ],
        ];

        $this->client = new Client($config);
    }

    /**
     * Forward any other call to guzzle client.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed|void
     */
    public function __call(string $method, array $parameters)
    {
        try {
            return \call_user_func_array([$this->client, $method], $parameters);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            //Log::error('Error: ' . $exception->getMessage());
        }
    }

    /**
     * @param $uri
     * @param array $options
     *
     * @return mixed
     *@throws GuzzleException
     *
     */
    public function getData($uri, array $options = []): mixed
    {
        return json_decode($this->client->get(ltrim($uri, '/'), $options)->getBody()->getContents());
    }

    /**
     * Perform a request.
     *
     * @param $method
     * @param string $uri
     * @param array  $options
     *
     * @return ResponseInterface
     * @throws GuzzleException
     *
     */
    public function request($method, string $uri = '', array $options = []): ResponseInterface
    {
        return $this->client->request($method, ltrim($uri, '/'), $options);
    }
}
