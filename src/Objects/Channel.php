<?php

namespace Astrotomic\DiscordSdk\Objects;

use Astrotomic\DiscordSdk\Casts\CarbonInterfaceCast;
use Astrotomic\DiscordSdk\Casts\StringableCast;
use Astrotomic\DiscordSdk\Values\Snowflake;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @link https://discord.com/developers/docs/resources/channel#channel-object
 */
class Channel extends Data
{
    public function __construct(
        #[WithCast(StringableCast::class)]
        public readonly Snowflake $id,
        public readonly int $type,
        #[WithCast(StringableCast::class)]
        public readonly ?Snowflake $guild_id = null,
        public readonly ?int $position = null,
        public readonly ?array $permission_overwrites = null,
        public readonly ?string $name = null,
        public readonly ?string $topic = null,
        public readonly ?bool $nsfw = null,
        #[WithCast(StringableCast::class)]
        public readonly ?Snowflake $last_message_id = null,
        public readonly ?int $bitrate = null,
        public readonly ?int $user_limit = null,
        public readonly ?int $rate_limit_per_user = null,
        public readonly ?array $recipients = null,
        public readonly ?string $icon = null,
        #[WithCast(StringableCast::class)]
        public readonly ?Snowflake $owner_id = null,
        #[WithCast(StringableCast::class)]
        public readonly ?Snowflake $application_id = null,
        public readonly ?bool $managed = null,
        #[WithCast(StringableCast::class)]
        public readonly ?Snowflake $parent_id = null,
        #[WithCast(CarbonInterfaceCast::class)]
        public readonly ?CarbonImmutable $last_pin_timestamp = null,
        public readonly ?string $rtc_region = null,
        public readonly ?int $video_quality_mode = null,
        public readonly ?int $message_count = null,
        public readonly ?int $member_count = null,
        public readonly ?array $thread_metadata = null,
        public readonly ?array $member = null,
        public readonly ?int $default_auto_archive_duration = null,
        public readonly ?string $permissions = null,
        public readonly ?int $flags = null,
        public readonly ?int $total_message_sent = null,
        public readonly ?array $available_tags = null,
        public readonly ?array $applied_tags = null,
        public readonly ?array $default_reaction_emoji = null,
        public readonly ?int $default_thread_rate_limit_per_user = null,
        public readonly ?int $default_sort_order = null,
        public readonly ?int $default_forum_layout = null,
    ) {}
}
