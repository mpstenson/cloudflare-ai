# This package allows you to interact with Cloudflare AI web services.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mpstenson/cloudflare-ai.svg?style=flat-square)](https://packagist.org/packages/mpstenson/cloudflare-ai)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mpstenson/cloudflare-ai/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mpstenson/cloudflare-ai/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mpstenson/cloudflare-ai/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mpstenson/cloudflare-ai/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mpstenson/cloudflare-ai.svg?style=flat-square)](https://packagist.org/packages/mpstenson/cloudflare-ai)

The cloudflare-ai package provides easy access to the cloudflare ai rest web services in Laravel.

## Installation

You can install the package via composer:

```bash
composer require mpstenson/cloudflare-ai
```

This package relies on two .env var settings. 
```CLOUDFLARE_ACCOUNT_ID```
```CLOUDFLARE_API_TOKEN```

The API token used needs to have access to the cloudflare ai tools. You can get details on generating the cloudflare token here https://developers.cloudflare.com/workers-ai/get-started/rest-api/. 
You can publish the config file with:

```bash
php artisan vendor:publish --tag="cloudflare-ai-config"
```

This is the contents of the published config file:

```php
<?php

// config for mpstenson/CloudflareAI
return [
    'api_url' => 'https://api.cloudflare.com/client/v4',
    'account_id' => env('CLOUDFLARE_ACCOUNT_ID', ''),
    'api_token' => env('CLOUDFLARE_API_TOKEN', ''),
    'default_model' => env('CLOUDFLARE_DEFAULT_MODEL', 'meta/llama-3-8b-instruct'),
    'default_speech_to_text_model' => env('CLOUDFLARE_DEFAULT_SPEECH_TO_TEXT_MODEL', 'openai/whisper'),
    'default_image_classification_model' => env('CLOUDFLARE_DEFAULT_IMAGE_CLASSIFICATION_MODEL', 'microsoft/resnet-50'),
];
```

Default models can be optionally specified in the .env file. If default models are specified they can still be overwritten on specific method calls.
```CLOUDFLARE_DEFAULT_MODEL```
```CLOUDFLARE_DEFAULT_SPEECH_TO_TEXT_MODEL```
```CLOUDFLARE_DEFAULT_IMAGE_CLASSIFICATION_MODEL```

## Usage

### Run a completion
```php
    use mpstenson\CloudflareAI\CloudflareAI;

        $response = CloudflareAI::runModel([
           'messages' => [
               ['role' => 'system', 'content' => 'You are a friendly assistant'],
                ['role' => 'user', 'content' => 'Why is pizza so good'],
           ]
        ],'meta/llama-2-7b-chat-int8');
```
### Transcribe Audio
```php
    use mpstenson\CloudflareAI\CloudflareAI;

        $whisper = CloudflareAI::runSpeechToText(fopen(storage_path().'/app/public/test.mp3', 'r'),'openai/whisper');
```
## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Matt Stenson](https://github.com/mpstenson)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
