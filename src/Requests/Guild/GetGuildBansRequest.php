<?php

namespace Astrotomic\DiscordSdk\Requests\Guild;

use Astrotomic\DiscordSdk\Objects\Ban;
use Astrotomic\DiscordSdk\Queries\Guild\GetGuildBansQuery;
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
 * @link https://discord.com/developers/docs/resources/guild#get-guild-bans
 */
class GetGuildBansRequest extends Request
{
    use CreatesDtoFromResponse;
    use HasRateLimits;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $guildId,
        GetGuildBansQuery $query = new GetGuildBansQuery,
    ) {
        $this->query = $query;
    }

    public function resolveEndpoint(): string
    {
        return "/guilds/{$this->guildId}/bans";
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
     * @return Collection<string, Ban>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return collect(Ban::collect($response->collect()))
            ->keyBy('user.id');
    }
}
