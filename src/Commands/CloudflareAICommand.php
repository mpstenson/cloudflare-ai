<?php

namespace mpstenson\CloudflareAI\Commands;

use Illuminate\Console\Command;

class CloudflareAICommand extends Command
{
    public $signature = 'cloudflare-ai';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
