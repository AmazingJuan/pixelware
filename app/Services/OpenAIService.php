<?php

/*
 * OpenAIService.php
 * Service for managing AI description for products.
 * Author: Santiago Manco
*/

namespace App\Services;


// Third-party / packages
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
        // Construct the specifications text if specs are provided
        $specsText = '';
        if (! empty($productSpecs)) {
            $specsText = "Specifications:\n";
            foreach ($productSpecs as $key => $value) {
                $specsText .= "- {$key}: {$value}\n";
            }
        }

        // Create the prompt for the AI model
        $prompt = "Provide a detailed, engaging product description in English for the following product:\n\n"
            ."Name: {$productName}\n"
            ."Description: {$productDescription}\n\n"
            ."{$specsText}\n"
            .'Make it attractive for potential buyers.';

        // Call the OpenAI API to generate the description
        $response = $this->client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a product marketing assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        // Convert the markdown response to HTML
        $markdown = trim($response->choices[0]->message->content);
        $converter = new CommonMarkConverter;

        // Return the HTML content
        return $converter->convert($markdown)->getContent();
    }
}
