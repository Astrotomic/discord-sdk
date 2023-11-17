<?php

namespace Astrotomic\DiscordSdk\Resources;

use Astrotomic\DiscordSdk\Objects\User;
use Astrotomic\DiscordSdk\Requests\User\GetUserRequest;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Saloon\Http\BaseResource;

class UserResource extends BaseResource
{
    public function getUser(
        Snowflake $userId,
    ): User {
        return $this->connector->send(
            new GetUserRequest(
                userId: $userId,
            )
        )->dtoOrFail();
    }
}
