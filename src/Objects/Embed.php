<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Casts\CarbonInterfaceCast;
use Astrotomic\DiscordSdk\Casts\ValueObjectCast;
use Astrotomic\DiscordSdk\Enums\EmbedType;
use Astrotomic\DiscordSdk\Structures\EmbedField;
use Astrotomic\DiscordSdk\Structures\EmbedImage;
use Astrotomic\DiscordSdk\Values\Color;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @link https://discord.com/developers/docs/resources/channel#embed-object
 */
class Embed extends Data
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?EmbedType $type,
        public readonly ?string $description,
        public readonly ?string $url,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly ?CarbonImmutable $timestamp,
        #[WithCast(ValueObjectCast::class)]
        public readonly ?Color $color,
        public readonly ?array $footer, // ToDo
        public readonly ?EmbedImage $image,
        public readonly ?array $thumbnail, // ToDo
        public readonly ?array $video, // ToDo
        public readonly ?array $provider, // ToDo
        public readonly ?array $author, // ToDo
        #[DataCollectionOf(EmbedField::class)]
        public readonly ?DataCollection $fields,
    ) {
    }
}
