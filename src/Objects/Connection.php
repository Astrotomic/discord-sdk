<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Enums\ConnectionService;
use Astrotomic\DiscordSdk\Enums\VisibilityType;
use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/user#connection-object
 */
class Connection extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ConnectionService $type,
        public readonly ?bool $revoked,
        public readonly ?array $integrations,
        public readonly bool $verified,
        public readonly bool $friend_sync,
        public readonly bool $show_activity,
        public readonly bool $two_way_link,
        public readonly VisibilityType $visibility,
    ) {}
}
