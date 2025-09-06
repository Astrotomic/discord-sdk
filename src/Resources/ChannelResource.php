<?php

namespace Astrotomic\DiscordSdk\Resources;

use Astrotomic\DiscordSdk\Objects\Message;
use Astrotomic\DiscordSdk\Objects\User;
use Astrotomic\DiscordSdk\Queries\Channel\GetChannelMessagesQuery;
use Astrotomic\DiscordSdk\Queries\Channel\ListPublicArchivedThreadsQuery;
use Astrotomic\DiscordSdk\Requests\Channel\CreateMessageRequest;
use Astrotomic\DiscordSdk\Requests\Channel\CreateReactionRequest;
use Astrotomic\DiscordSdk\Requests\Channel\GetChannelMessagesRequest;
use Astrotomic\DiscordSdk\Requests\Channel\GetReactionsRequest;
use Astrotomic\DiscordSdk\Requests\Channel\ListPublicArchivedThreadsRequest;
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

    /**
     * @return Collection<string, Message>
     */
    public function listPublicArchivedThreads(
        Snowflake $channelId,
        ListPublicArchivedThreadsQuery $query = new ListPublicArchivedThreadsQuery
    ): Collection {
        return $this->connector->send(
            new ListPublicArchivedThreadsRequest(
                channelId: $channelId,
                query: $query
            )
        )->dtoOrFail();
    }

    public function createReaction(
        Snowflake $channelId,
        Snowflake $messageId,
        string $emoji,
    ): bool {
        return $this->connector->send(
            new CreateReactionRequest(
                channelId: $channelId,
                messageId: $messageId,
                emoji: $emoji,
            )
        )->dtoOrFail();
    }

    /**
     * @return Collection<string, User>
     */
    public function getReactions(
        Snowflake $channelId,
        Snowflake $messageId,
        string $emoji,
    ): Collection {
        return $this->connector->send(
            new GetReactionsRequest(
                channelId: $channelId,
                messageId: $messageId,
                emoji: $emoji,
            )
        )->dtoOrFail();
    }

    public function createMessage(
        Snowflake $channelId,
        array $data,
    ): Message {
        return $this->connector->send(
            new CreateMessageRequest(
                channelId: $channelId,
                data: $data,
            )
        )->dtoOrFail();
    }
}
