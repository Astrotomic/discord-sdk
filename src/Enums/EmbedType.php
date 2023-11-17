<?php

namespace Astrotomic\DiscordSdk\Enums;

/**
 * @link https://discord.com/developers/docs/resources/channel#embed-object-embed-types
 */
enum EmbedType: string
{
    case RICH = 'rich'; //generic embed rendered from embed attributes
    case IMAGE = 'image';	//image embed
    case VIDEO = 'video';	//video embed
    case GIFV = 'gifv';	//animated gif image embed rendered as a video embed
    case ARTICLE = 'article';	//article embed
    case LINK = 'link';	//link embed
}
