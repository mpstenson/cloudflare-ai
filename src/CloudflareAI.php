<?php

namespace mpstenson\CloudflareAI;

use Illuminate\Support\Facades\Http;

class CloudflareAI
{
    public function __construct()
    {

    }

    /**
     * Runs a Cloudflare AI model with the given input.
     *
     * @param string $modelName The name of the model to run.
     * @param array<string, mixed> $input The input for the model.
     * @return array<string, mixed> The output of the model.
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function runModel(string $modelName, array $input): array
    {
        $url = config('cloudflare-ai.api_url').'/accounts/'.config('cloudflare-ai.account_id').'/ai/run/@cf/'.$modelName;
        
        try {
            $response = Http::withToken(config('cloudflare-ai.api_token'))
                            ->contentType('application/json')
                            ->post($url, $input);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Runs a Cloudflare AI speech to text model with the given audio file.
     *
     * @param string $modelName The name of the model to run.
     * @param string $file The audio file to send to the model. This is the body of the file
     * @return array<string, mixed> The output of the model.
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function runSpeechToText(string $modelName, $file): array
    {
        $url = config('cloudflare-ai.api_url') . '/accounts/' . config('cloudflare-ai.account_id') . '/ai/run/@cf/' . $modelName;

        try {
            $response = Http::withToken(config('cloudflare-ai.api_token'))
                ->contentType('application/octet-stream')
                ->withBody($file, 'application/octet-stream')
                ->post($url);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()], 500);
        }
    }


    /**
     * Runs a Cloudflare AI image classification model with the given image file.
     *
     * @param string $modelName The name of the model to run.
     * @param string $file The image file to send to the model. This is the body of the file.
     * @return array<string, mixed> The output of the model.
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function runImageClassification(
        string $modelName,
        string $file
    ): array {
        $url = config('cloudflare-ai.api_url')
            . '/accounts/'
            . config('cloudflare-ai.account_id')
            . '/ai/run/@cf/'
            . $modelName;
        
        try {
            $response = Http::withToken(config('cloudflare-ai.api_token'))
                ->contentType('application/octet-stream')
                ->withBody($file, 'application/octet-stream')
                ->post($url);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(
                ['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()],
                500
            );
        }
    }


    /**
     * Get a list of finetunes.
     *
     * @return array<string, mixed>[] The list of finetunes
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function listFinetunes(): array
    {
        $url = config('cloudflare-ai.api_url') . '/accounts/' . config('cloudflare-ai.account_id') . '/ai/finetunes';
        
        try {
            $response = Http::withToken(config('cloudflare-ai.api_token'))
                ->get($url);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Create a new finetune.
     *
     * @param string $description A description of the finetune
     * @param string $model The ID of the model to finetune
     * @param string $name The name of the finetune
     *
     * @return array The created finetune object
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function createFinetune(string $description = '', string $model, string $name): array
    {
        $url = config('cloudflare-ai.api_url').'/accounts/'.config('cloudflare-ai.account_id').'/ai/finetunes';
        $input = [
            'description' => $description,
            'model' => $model,
            'name' => $name
        ];
        try {
            $response = Http::withToken(config('cloudflare-ai.api_token'))
                            ->contentType('application/json')
                            ->post($url, $input);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Search for models in the Cloudflare AI Model Catalog.
     *
     * @param string|null $author Filter by author
     * @param bool        $hide_experimental Hide experimental models
     * @param int         $page Page number
     * @param int         $per_page Number of models per page
     * @param string|null $search Filter by search query
     * @param string|null $source Filter by source language
     * @param string|null $task Filter by task
     *
     * @return array<array<string,mixed>> List of models
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function listModels(?string $author = null, bool $hide_experimental = false, int $page = 1, int $per_page = 50, ?string $search = null, ?string $source = null, ?string $task = null): array
    {
        $queryString = '?per_page='.$per_page.'&page='.$page;
        if ($hide_experimental) {
            $queryString .= '&hide_experimental=true';
        } else {
            $queryString .= '&hide_experimental=false';
        }
        if ($author !== null) {
            $queryString .= '&author='.$author;
        }
        if ($search !== null) {
            $queryString .= '&search='.$search;
        }
        if ($source !== null) {
            $queryString .= '&source='.$source;
        }
        if ($task !== null) {
            $queryString .= '&task='.$task;
        }
        $url = config('cloudflare-ai.api_url').'/accounts/'.config('cloudflare-ai.account_id').'/ai/models/search'.$queryString;

        $response = Http::withToken(config('cloudflare-ai.api_token'))
                        ->get($url);

        return $response->json();
    }
}
