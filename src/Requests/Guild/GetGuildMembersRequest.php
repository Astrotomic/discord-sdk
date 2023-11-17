<?php

namespace Astrotomic\DiscordSdk\Requests\Guild;

use Astrotomic\DiscordSdk\Objects\GuildMember;
use Astrotomic\DiscordSdk\Queries\Guild\GetGuildMembersQuery;
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
 * @link https://discord.com/developers/docs/resources/guild#list-guild-members
 */
class GetGuildMembersRequest extends Request
{
    use CastDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $guildId,
        GetGuildMembersQuery $query = new GetGuildMembersQuery(),
    ) {
        $this->query = $query;
    }

    public function resolveEndpoint(): string
    {
        return "/guilds/{$this->guildId}/members";
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
     * @return Enumerable<string, GuildMember>
     */
    public function createDtoFromResponse(Response $response): Enumerable
    {
        return GuildMember::collection($response->collect())
            ->toCollection()
            ->keyBy('user.id');
    }
}
