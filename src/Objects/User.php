<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Casts\ValueObjectCast;
use Astrotomic\DiscordSdk\Enums\PremiumType;
use Astrotomic\DiscordSdk\Values\Color;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/user#user-object
 */
class User extends Data
{
    public function __construct(
        #[WithCast(ValueObjectCast::class)]
        public readonly Snowflake $id,
        public readonly string $username,
        public readonly string $discriminator,
        public readonly ?string $global_name,
        public readonly ?string $avatar,
        public readonly ?bool $bot,
        public readonly ?bool $system,
        public readonly ?bool $mfa_enabled,
        public readonly ?string $banner,
        #[WithCast(ValueObjectCast::class)]
        public readonly ?Color $accent_color,
        public readonly ?string $locale,
        public readonly ?bool $verified,
        public readonly ?string $email,
        public readonly ?int $flags,
        public readonly ?PremiumType $premium_type,
        public readonly ?int $public_flags,
        public readonly ?string $avatar_decoration,
    ) {
    }

    public function avatar(): ?string
    {
        return $this->avatar
            ? "https://cdn.discordapp.com/avatars/{$this->id}/{$this->avatar}.png"
            : null;
    }
}
