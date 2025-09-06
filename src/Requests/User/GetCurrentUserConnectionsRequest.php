<?php

namespace Astrotomic\DiscordSdk\Requests\User;

use Astrotomic\DiscordSdk\Objects\Connection;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://discord.com/developers/docs/resources/user#get-current-user-connections
 */
class GetCurrentUserConnectionsRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/users/@me/connections';
    }

    /**
     * @return Collection<string, Connection>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return collect(Connection::collect($response->collect()))
            ->keyBy('id');
    }
}
