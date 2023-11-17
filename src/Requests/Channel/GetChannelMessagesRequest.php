<?php

namespace Astrotomic\DiscordSdk\Requests\Channel;

use Astrotomic\DiscordSdk\Objects\Message;
use Astrotomic\DiscordSdk\Queries\Channel\GetChannelMessagesQuery;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Cache;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\LaravelCacheStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Request\CastDtoFromResponse;

/**
 * @link https://discord.com/developers/docs/resources/channel#get-channel-messages
 */
class GetChannelMessagesRequest extends Request
{
    use CastDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $channelId,
        GetChannelMessagesQuery $query = new GetChannelMessagesQuery,
    ) {
        $this->query = $query;
    }

    public function resolveEndpoint(): string
    {
        return "/channels/{$this->channelId}/messages";
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new LaravelCacheStore(Cache::store());
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(1)->everySeconds(5)->sleep(),
        ];
    }

    /**
     * @return Enumerable<string, Message>
     */
    public function createDtoFromResponse(Response $response): Enumerable
    {
        return Message::collection($response->collect())
            ->toCollection()
            ->keyBy('id');
    }
}
