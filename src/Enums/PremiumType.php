<?php

namespace Astrotomic\DiscordSdk\Enums;

/**
 * @link https://discord.com/developers/docs/resources/user#user-object-premium-types
 */
enum PremiumType: int
{
    case NONE = 0;
    case NITRO_CLASSIC = 1;
    case NITRO = 2;
    case NITRO_BASIC = 3;
}
