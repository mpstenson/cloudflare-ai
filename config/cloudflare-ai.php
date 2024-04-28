<?php

// config for mpstenson/CloudflareAI
return [
    'api_url' => 'https://api.cloudflare.com/client/v4',
    'account_id' => env('CLOUDFLARE_ACCOUNT_ID', ''),
    'api_token' => env('CLOUDFLARE_API_TOKEN', '')
];
