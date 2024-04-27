<?php

namespace mpstenson\CloudflareAI;

use Illuminate\Support\Facades\Http;

class CloudflareAI
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function runModel($modelName, $input)
    {
        $url = "{$this->config['api_url']}/accounts/{$this->config['account_id']}/ai/run/@cf/{$modelName}";
        
        try {
            $response = Http::withToken($this->config['api_token'])
                            ->contentType('application/json')
                            ->post($url, ['text' => $input]);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()], 500);
        }
    }

    public function runSpeechRecognition($modelName, $input)
    {
        $url = "{$this->config['api_url']}/accounts/{$this->config['account_id']}/ai/run/@cf/{$modelName}";
        
        try {
            $response = Http::withToken($this->config['api_token'])
                            ->contentType('application/octet-stream')
                            ->post($url, ['string' => $input]);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle the error according to your application's needs
            return response()->json(['error' => 'Request to Cloudflare API failed', 'details' => $e->getMessage()], 500);
        }
    }
}
