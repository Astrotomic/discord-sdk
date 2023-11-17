<?php

namespace Astrotomic\DiscordSdk\Requests\Guild;

use Astrotomic\DiscordSdk\Objects\GuildMember;
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
 * @link https://discord.com/developers/docs/resources/guild#get-guild-member
 */
class GetGuildMemberRequest extends Request
{
    use CreatesDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $guildId,
        public readonly Snowflake $userId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/guilds/{$this->guildId}/members/{$this->userId}";
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

    public function createDtoFromResponse(Response $response): GuildMember
    {
        return GuildMember::from($response->json());
    }
}
