<?php

namespace Astrotomic\DiscordSdk\Resources;

use Saloon\Http\Connector;

abstract class Resource
{
    public function __construct(protected readonly Connector $connector)
    {
    }
}
