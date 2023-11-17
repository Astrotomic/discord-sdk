<?php

namespace Astrotomic\DiscordSdk\Structures;

use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/channel#embed-object-embed-image-structure
 */
class EmbedImage extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $proxy_url,
        public readonly ?int $height,
        public readonly ?int $width,
    ) {
    }
}
