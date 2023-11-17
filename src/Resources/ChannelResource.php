<?php

namespace Astrotomic\DiscordSdk\Resources;

use Astrotomic\DiscordSdk\Objects\Message;
use Astrotomic\DiscordSdk\Queries\Channel\GetChannelMessagesQuery;
use Astrotomic\DiscordSdk\Requests\Channel\GetChannelMessagesRequest;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Collection;
use Saloon\Http\BaseResource;

class ChannelResource extends BaseResource
{
    /**
     * @return Collection<string, Message>
     */
    public function getChannelMessages(
        Snowflake $channelId,
        GetChannelMessagesQuery $query = new GetChannelMessagesQuery
    ): Collection {
        return $this->connector->send(
            new GetChannelMessagesRequest(
                channelId: $channelId,
                query: $query
            )
        )->dtoOrFail();
    }
}
