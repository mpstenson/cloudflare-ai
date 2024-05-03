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
