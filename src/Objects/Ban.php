<?php

namespace Astrotomic\DiscordSdk\Objects;

use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/guild#ban-object
 */
class Ban extends Data
{
    public function __construct(
        public readonly ?string $reason,
        public readonly User $user,
    ) {
    }
}
