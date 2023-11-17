<?php

namespace Astrotomic\DiscordSdk\Queries\Channel;

use Astrotomic\DiscordSdk\Queries\Query;
use Astrotomic\DiscordSdk\Values\Snowflake;

class GetChannelMessagesQuery extends Query
{
    public function __construct(
        int $limit = 50,
        Snowflake $around = null,
        Snowflake $before = null,
        Snowflake $after = null,
    ) {
        parent::__construct([
            'limit' => clamp(1, $limit, 100),
            'around' => $around,
            'before' => $before,
            'after' => $after,
        ]);
    }
}
