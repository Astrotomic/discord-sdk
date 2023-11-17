<?php

namespace Astrotomic\DiscordSdk\Resources;

use Astrotomic\DiscordSdk\Objects\Ban;
use Astrotomic\DiscordSdk\Objects\GuildMember;
use Astrotomic\DiscordSdk\Objects\Role;
use Astrotomic\DiscordSdk\Queries\Guild\GetGuildBansQuery;
use Astrotomic\DiscordSdk\Queries\Guild\GetGuildMembersQuery;
use Astrotomic\DiscordSdk\Requests\Guild\GetGuildBansRequest;
use Astrotomic\DiscordSdk\Requests\Guild\GetGuildMemberRequest;
use Astrotomic\DiscordSdk\Requests\Guild\GetGuildMembersRequest;
use Astrotomic\DiscordSdk\Requests\Guild\GetGuildRolesRequest;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Collection;
use Saloon\Http\BaseResource;

class GuildResource extends BaseResource
{
    /**
     * @return Collection<string, Ban>
     */
    public function getGuildBans(
        Snowflake $guildId,
        GetGuildBansQuery $query = new GetGuildBansQuery()
    ): Collection {
        return $this->connector->send(
            new GetGuildBansRequest(
                guildId: $guildId,
                query: $query,
            )
        )->dtoOrFail();
    }

    /**
     * @return Collection<string, Role>
     */
    public function getGuildRoles(Snowflake $guildId): Collection
    {
        return $this->connector->send(
            new GetGuildRolesRequest(
                guildId: $guildId
            )
        )->dtoOrFail();
    }

    /**
     * @return Collection<string, GuildMember>
     */
    public function getGuildMembers(
        Snowflake $guildId,
        GetGuildMembersQuery $query = new GetGuildMembersQuery()
    ): Collection {
        return $this->connector->send(
            new GetGuildMembersRequest(
                guildId: $guildId,
                query: $query
            )
        )->dtoOrFail();
    }

    public function getGuildMember(
        Snowflake $guildId,
        Snowflake $userId,
    ): GuildMember {
        return $this->connector->send(
            new GetGuildMemberRequest(
                guildId: $guildId,
                userId: $userId
            )
        )->dtoOrFail();
    }
}
