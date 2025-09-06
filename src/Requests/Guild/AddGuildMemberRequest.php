<?php

namespace Astrotomic\DiscordSdk\Requests\Guild;

use Astrotomic\DiscordSdk\Values\Snowflake;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://discord.com/developers/docs/resources/guild#add-guild-member
 */
class AddGuildMemberRequest extends Request implements HasBody
{
    use CreatesDtoFromResponse;
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        public readonly Snowflake $guildId,
        public readonly Snowflake $userId,
        public readonly string $accessToken,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/guilds/{$this->guildId}/members/{$this->userId}";
    }

    protected function defaultBody(): array
    {
        return [
            'access_token' => $this->accessToken,
        ];
    }

    public function createDtoFromResponse(Response $response): bool
    {
        return $response->successful();
    }
}
