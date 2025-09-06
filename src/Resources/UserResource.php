<?php

namespace Astrotomic\DiscordSdk\Resources;

use Astrotomic\DiscordSdk\Objects\Connection;
use Astrotomic\DiscordSdk\Requests\User\GetCurrentUserConnectionsRequest;
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
}
