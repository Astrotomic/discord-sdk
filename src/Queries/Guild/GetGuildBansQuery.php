<?php

namespace Astrotomic\DiscordSdk\Queries\Guild;

use Astrotomic\DiscordSdk\Queries\Query;
use Astrotomic\DiscordSdk\Values\Snowflake;

class GetGuildBansQuery extends Query
{
    public function __construct(
        int $limit = 1000,
        Snowflake $before = null,
        Snowflake $after = null,
    ) {
        parent::__construct([
            'limit' => clamp(1, $limit, 1000),
            'before' => $before,
            'after' => $after,
        ]);
    }
}
