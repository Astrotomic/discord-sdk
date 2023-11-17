<?php

namespace Astrotomic\DiscordSdk\Structures;

use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/channel#embed-object-embed-field-structure
 */
class EmbedField extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
        public readonly ?bool $inline,
    ) {
    }
}
