<?php

namespace Brucelwayne\AI\LLMs;

use OpenAI;

class ChatGPT extends \Adrenallen\AiAgentsLaravel\ChatModels\ChatGPT
{

    /**
     * @param string $model
     * @param array $context
     * @param array $openAiOptions
     */
    public function __construct($context = [], $prePrompt = "", $functions = [], $model = 'gpt-3.5-turbo', $openAiOptions = [])
    {

        parent::__construct($context, $prePrompt, $functions);

        $this->model = $model;
//            OpenAI\Laravel\Facades\OpenAI::chat();
//        $this->client = OpenAI::client(config('openai.api_key'));

        if (config('app.debug')) {
            $this->client = OpenAI::factory()
                ->withApiKey(config('openai.api_key'))
                ->withHttpClient(new \GuzzleHttp\Client([
                    "proxy" => [
                        'http' => 'http://127.0.0.1:7890',
                        'https' => 'http://127.0.0.1:7890',
                    ],
                    'verify' => false
                ]))
                ->withBaseUri(config('openai.base_url'))
                ->make();
        } else {
            $this->client = OpenAI::factory()
                ->withApiKey(config('openai.api_key'))
                ->withBaseUri(config('openai.base_url'))
                ->make();
        }

        $this->context = $context;
        $this->openAiOptions = $openAiOptions;
    }
}