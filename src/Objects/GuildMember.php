<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Casts\CarbonInterfaceCast;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/guild#guild-member-object
 */
class GuildMember extends Data
{
    public function __construct(
        public readonly User $user,
        public readonly ?string $nick,
        public readonly ?string $avatar,
        public readonly array $roles,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly CarbonImmutable $joined_at,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly ?CarbonImmutable $premium_since,
        public readonly bool $deaf,
        public readonly bool $mute,
        public readonly int $flags,
        public readonly ?bool $pending,
        public readonly ?string $permissions,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly ?CarbonImmutable $communication_disabled_until,
    ) {
    }
}
