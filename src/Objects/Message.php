<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Casts\CarbonInterfaceCast;
use Astrotomic\DiscordSdk\Casts\ValueObjectCast;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @link https://discord.com/developers/docs/resources/channel#message-object
 */
class Message extends Data
{
    public function __construct(
        #[WithCast(ValueObjectCast::class)]
        public readonly Snowflake $id,
        #[WithCast(ValueObjectCast::class)]
        public readonly Snowflake $channel_id,
        public readonly User $author,
        public readonly ?string $content,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly CarbonImmutable $timestamp,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly ?CarbonImmutable $edited_timestamp,
        public readonly bool $tts,
        public readonly bool $mention_everyone,
        public readonly array $mentions, // ToDo
        public readonly array $mention_roles, // ToDo
        public readonly ?array $mention_channels, // ToDo
        public readonly array $attachments, // ToDo
        #[DataCollectionOf(Embed::class)]
        public readonly DataCollection $embeds,
        public readonly ?array $reactions, // ToDo
        public readonly null|int|string $nonce,
        public readonly bool $pinned,
        #[WithCast(ValueObjectCast::class)]
        public readonly ?Snowflake $webhook_id,
        public readonly int $type, // ToDo
        public readonly ?array $activity, // ToDo
        public readonly ?array $application, // ToDo
        #[WithCast(ValueObjectCast::class)]
        public readonly ?Snowflake $application_id, // ToDo
        public readonly ?array $message_reference, // ToDo
        public readonly int $flags, // ToDo
        public readonly ?array $referenced_message, // ToDo
        public readonly ?array $interaction, // ToDo
        public readonly ?array $thread, // ToDo
        public readonly ?array $components, // ToDo
        public readonly ?array $sticker_items, // ToDo
        public readonly ?array $stickers, // ToDo
        public readonly ?int $position, // ToDo
        public readonly ?array $role_subscription_data, // ToDo
    ) {
    }
}
