<?php

use App\Integrations\OpenAI\OpenAIApi;
use App\Integrations\OpenAI\OpenAIClient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $api = new OpenAIApi(new OpenAIClient());

    $response = $api->test();

    dd($response);
});
