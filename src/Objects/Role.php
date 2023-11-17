<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Casts\ValueObjectCast;
use Astrotomic\DiscordSdk\Values\Color;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/topics/permissions#role-object
 */
class Role extends Data
{
    public function __construct(
        #[WithCast(ValueObjectCast::class)]
        public readonly Snowflake $id,
        public readonly string $name,
        #[WithCast(ValueObjectCast::class)]
        public readonly Color $color,
        public readonly bool $hoist,
        public readonly ?string $icon,
        public readonly ?string $unicode_emoji,
        public readonly int $position,
        public readonly string $permissions,
        public readonly bool $managed,
        public readonly bool $mentionable,
        public readonly ?array $tags, // ToDo
        public readonly int $flags, // ToDo
    ) {
    }
}
