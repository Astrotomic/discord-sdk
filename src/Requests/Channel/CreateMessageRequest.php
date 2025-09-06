<?php

namespace Astrotomic\DiscordSdk\Requests\Channel;

use Astrotomic\DiscordSdk\Objects\Message;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Facades\Cache;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\LaravelCacheStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://discord.com/developers/docs/resources/channel#create-message
 */
class CreateMessageRequest extends Request implements HasBody
{
    use CreatesDtoFromResponse;
    use HasJsonBody;
    use HasRateLimits;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly Snowflake $channelId,
        public readonly array $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/channels/{$this->channelId}/messages";
    }

    protected function defaultBody(): array
    {
        return $this->data;
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

    public function createDtoFromResponse(Response $response): Message
    {
        return Message::from($response->json());
    }
}
