<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
use mpstenson\CloudflareAI\CloudflareAI;
use mpstenson\CloudflareAI\Tests\TestCase;

class runSpeechToTextTest extends TestCase
{
    /**
     * Test that the runModel method returns a JSON response.
     *
     * @return void
     */
    public function test_run_model_returns_json_response()
    {
        // Arrange
        $modelName = 'test-model';
        $input = 'test-input';
        $expectedResponse = ['output' => 'result'];
        Http::fake([
            config('cloudflare-ai.api_url').'/accounts/'.config('cloudflare-ai.account_id').'/ai/run/@cf/'.$modelName => Http::response($expectedResponse, 200),
        ]);

        // Act
        $result = CloudflareAI::runSpeechToText($input,$modelName);

        // Assert
        $this->assertEquals($expectedResponse, $result);
    }

    /**
     * Test that the runModel method throws an exception on error.
     *
     * @return void
     */
    public function test_run_model_throws_exception_on_error()
    {
        $expectedResponse = ['success' => false,
            'errors' => [],
            'messages' => [],
            'result' => null];
        $modelName = 'test-model';
        $input = 'test-input';
        Http::fake([
            config('cloudflare-ai.api_url').'/accounts/'.config('cloudflare-ai.account_id').'/ai/run/@cf/'.$modelName => Http::response($expectedResponse, 500),
        ]);
        // Act
        $result = CloudflareAI::runSpeechToText($input,$modelName);
        $this->assertEquals($expectedResponse, $result);
    }

    /**
     * Test that runModel defaults to model if none is specified.
     * 
     * @return void
     */
    public function test_run_model_defaults_to_model_if_none_specified() {
        $input = 'test-input';
        $expectedResponse = ['output' => 'result'];
        Http::fake([
            config('cloudflare-ai.api_url').'/accounts/'.config('cloudflare-ai.account_id').'/ai/run/@cf/'.config('cloudflare-ai.default_speech_to_text_model') => Http::response($expectedResponse, 200),
        ]);
        $result = CloudflareAI::runSpeechToText($input);
        $this->assertEquals($expectedResponse, $result);
    }
}
