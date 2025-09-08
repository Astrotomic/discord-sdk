<?php

namespace Astrotomic\DiscordSdk\Resources;

use Astrotomic\DiscordSdk\Objects\Connection;
use Astrotomic\DiscordSdk\Objects\User;
use Astrotomic\DiscordSdk\Requests\User\GetCurrentUserConnectionsRequest;
use Astrotomic\DiscordSdk\Requests\User\GetUserRequest;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Illuminate\Support\Collection;
use Saloon\Http\BaseResource;

class UserResource extends BaseResource
{
    /**
     * @return Collection<string, Connection>
     */
    public function getCurrentUserConnections(): Collection
    {
        return $this->connector->send(
            new GetCurrentUserConnectionsRequest
        )->dtoOrFail();
    }

    public function getUser(Snowflake $userId): User
    {
        return $this->connector->send(
            new GetUserRequest(
                userId: $userId,
            )
        )->dtoOrFail();
    }
}
