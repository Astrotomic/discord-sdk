<?php

namespace Astrotomic\DiscordSdk\Queries\Channel;

use Astrotomic\DiscordSdk\Queries\Query;
use Astrotomic\DiscordSdk\Values\Snowflake;

class ListPublicArchivedThreadsQuery extends Query
{
    public function __construct(
        int $limit = 50,
        ?Snowflake $before = null,
    ) {
        parent::__construct(array_filter([
            'limit' => clamp(1, $limit, 100),
            'before' => $before,
        ]));
    }
}
