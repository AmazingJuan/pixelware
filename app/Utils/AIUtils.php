<?php

namespace App\Utils;

// Third-party / packages
use League\CommonMark\CommonMarkConverter;
use OpenAI;

class AIUtils
{
    public static function generateProductDescription(string $productName, string $productDescription, array $productSpecs = []): string
    {
        $client = OpenAI::client(config('services.openai.api_key'));

        // Build specs text
        $specsText = '';
        if (!empty($productSpecs)) {
            $specsText = "Specifications:\n";
            foreach ($productSpecs as $key => $value) {
                $specsText .= "- {$key}: {$value}\n";
            }
        }

        // Build prompt
        $prompt = "Provide a detailed, engaging product description in English for the following product:\n\n"
            . "Name: {$productName}\n"
            . "Description: {$productDescription}\n\n"
            . "{$specsText}\n"
            . "Make it attractive for potential buyers.";

        // Call OpenAI API
        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a product marketing assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        // Convert markdown to HTML
        $markdown = trim($response->choices[0]->message->content);
        $converter = new CommonMarkConverter;

        return $converter->convert($markdown)->getContent();
    }
}
