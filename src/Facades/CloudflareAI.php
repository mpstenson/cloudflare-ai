<?php

namespace mpstenson\CloudflareAI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \mpstenson\CloudflareAI\CloudflareAI
 */
class CloudflareAI extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \mpstenson\CloudflareAI\CloudflareAI::class;
    }
}
