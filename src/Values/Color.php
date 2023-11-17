<?php

namespace Astrotomic\DiscordSdk\Values;

use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use OzdemirBurak\Iris\Color\Hex;
use Stringable;

class Color implements Stringable, JsonSerializable, Jsonable
{
    public readonly int $color;

    public readonly ?string $hex;

    public function __construct(int $color)
    {
        $this->color = $color;
        $this->hex = $color !== 0
            ? '#'.dechex($color)
            : null;
    }

    public function hex(): ?Hex
    {
        return $this->hex ? new Hex($this->hex) : null;
    }

    public function jsonSerialize(): int
    {
        return $this->color;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR | $options);
    }

    public function __toString(): string
    {
        return $this->color;
    }
}
