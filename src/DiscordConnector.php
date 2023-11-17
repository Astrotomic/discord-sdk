<?php

namespace Astrotomic\DiscordSdk;

use Astrotomic\DiscordSdk\Resources\ChannelResource;
use Astrotomic\DiscordSdk\Resources\GuildResource;
use Astrotomic\DiscordSdk\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Helpers\RetryAfterHelper;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\LaravelCacheStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;

class DiscordConnector extends Connector
{
    use AcceptsJson;
    use HasRateLimits;

    public function __construct(
        Authenticator $authenticator,
    ) {
        $this->authenticator = $authenticator;
    }

    public function resolveBaseUrl(): string
    {
        return 'https://discord.com/api/v10';
    }

    protected function defaultHeaders(): array
    {
        return [
            'User-Agent' => 'Discord-SDK (https://github.com/Astrotomic/discord-sdk, latest)',
        ];
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new LaravelCacheStore(Cache::store());
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(50)->everySeconds(1),
        ];
    }

    protected function handleTooManyAttempts(Response $response, Limit $limit): void
    {
        if ($response->status() !== 429) {
            return;
        }

        $limit->exceeded(
            releaseInSeconds: RetryAfterHelper::parse($response->header('X-RateLimit-Reset-After')),
        );
    }

    public function guild(): GuildResource
    {
        return new GuildResource($this);
    }

    public function channel(): ChannelResource
    {
        return new ChannelResource($this);
    }

    public function user(): UserResource
    {
        return new UserResource($this);
    }
}
