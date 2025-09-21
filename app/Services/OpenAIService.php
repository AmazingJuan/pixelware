<?php

namespace App\Services;

use League\CommonMark\CommonMarkConverter;
use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.api_key'));
    }

    public function generateProductDescription(string $productName, string $productDescription, array $productSpecs = []): string
    {
        $specsText = '';
        if (! empty($productSpecs)) {
            $specsText = "Specifications:\n";
            foreach ($productSpecs as $key => $value) {
                $specsText .= "- {$key}: {$value}\n";
            }
        }

        $prompt = "Provide a detailed, engaging product description in English for the following product:\n\n"
            ."Name: {$productName}\n"
            ."Description: {$productDescription}\n\n"
            ."{$specsText}\n"
            .'Make it attractive for potential buyers.';

        $response = $this->client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a product marketing assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $markdown = trim($response->choices[0]->message->content);
        $converter = new CommonMarkConverter;

        return $converter->convert($markdown)->getContent();
    }
}
