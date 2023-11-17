<?php

namespace Astrotomic\DiscordSdk\Queries\Guild;

use Astrotomic\DiscordSdk\Queries\Query;
use Astrotomic\DiscordSdk\Values\Snowflake;

class GetGuildMembersQuery extends Query
{
    public function __construct(
        int $limit = 1000,
        Snowflake $after = null,
    ) {
        parent::__construct([
            'limit' => clamp(1, $limit, 1000),
            'after' => $after,
        ]);
    }
}
