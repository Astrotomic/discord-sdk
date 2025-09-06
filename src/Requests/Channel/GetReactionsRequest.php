<?php

namespace Astrotomic\DiscordSdk\Requests\Channel;

use Astrotomic\DiscordSdk\Objects\User;
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
 * @link https://discord.com/developers/docs/resources/channel#get-reactions
 */
class GetReactionsRequest extends Request
{
    use CreatesDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $channelId,
        public readonly Snowflake $messageId,
        public readonly string $emoji,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/channels/{$this->channelId}/messages/{$this->messageId}/reactions/{$this->emoji}";
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new LaravelCacheStore(Cache::store());
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(5)->everySeconds(1)->sleep(),
        ];
    }

    /**
     * @return Collection<string, User>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return collect(User::collect($response->collect()))
            ->keyBy('id');
    }
}
