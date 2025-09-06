<?php

namespace Astrotomic\DiscordSdk\Requests\Channel;

use Astrotomic\DiscordSdk\Values\Snowflake;
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
 * @link https://discord.com/developers/docs/resources/channel#create-reaction
 */
class CreateReactionRequest extends Request
{
    use CreatesDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::PUT;

    public function __construct(
        public readonly Snowflake $channelId,
        public readonly Snowflake $messageId,
        public readonly string $emoji,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/channels/{$this->channelId}/messages/{$this->messageId}/reactions/{$this->emoji}/@me";
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new LaravelCacheStore(Cache::store());
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(1)->everySeconds(1)->sleep(),
        ];
    }

    public function createDtoFromResponse(Response $response): bool
    {
        return $response->successful();
    }
}
