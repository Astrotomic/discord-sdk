<?php

namespace Astrotomic\DiscordSdk\Requests\Channel;

use Astrotomic\DiscordSdk\Objects\Message;
use Astrotomic\DiscordSdk\Queries\Channel\ListPublicArchivedThreadsQuery;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\LaravelCacheStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://discord.com/developers/docs/resources/channel#get-channel-messages
 */
class ListPublicArchivedThreadsRequest extends Request
{
    use CreatesDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $channelId,
        ListPublicArchivedThreadsQuery $query = new ListPublicArchivedThreadsQuery,
    ) {
        $this->query = $query;
    }

    public function resolveEndpoint(): string
    {
        return "/channels/{$this->channelId}/threads/archived/public";
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
     * @return Collection<string, Message>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return $response->collect();
    }
}
