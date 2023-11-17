<?php

namespace Astrotomic\DiscordSdk\Requests\User;

use Astrotomic\DiscordSdk\Objects\Ban;
use Astrotomic\DiscordSdk\Objects\User;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Enumerable;
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
 * @link https://discord.com/developers/docs/resources/user#get-user
 */
class GetUserRequest extends Request
{
    use CreatesDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $userId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/users/{$this->userId}";
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new LaravelCacheStore(Cache::store());
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(10)->everySeconds(10)->sleep(),
        ];
    }

    /**
     * @return Enumerable<string, Ban>
     */
    public function createDtoFromResponse(Response $response): User
    {
        return User::from($response->json());
    }
}
