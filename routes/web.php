<?php

use App\Integrations\OpenAI\OpenAIApi;
use App\Integrations\OpenAI\OpenAIClient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   dd('Tadaaa! the image is working!');
});
