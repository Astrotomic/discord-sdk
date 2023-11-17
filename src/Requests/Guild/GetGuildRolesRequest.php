<?php

namespace Astrotomic\DiscordSdk\Requests\Guild;

use Astrotomic\DiscordSdk\Objects\Role;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Enumerable;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://discord.com/developers/docs/resources/guild#get-guild-roles
 */
class GetGuildRolesRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly Snowflake $guildId
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/guilds/{$this->guildId}/roles";
    }

    /**
     * @return Enumerable<string, Role>
     */
    public function createDtoFromResponse(Response $response): Enumerable
    {
        return Role::collection($response->collect())
            ->toCollection()
            ->keyBy('id');
    }
}
