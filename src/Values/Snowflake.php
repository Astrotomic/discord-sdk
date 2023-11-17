<?php

namespace Astrotomic\DiscordSdk\Values;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Jsonable;
use InvalidArgumentException;
use JsonSerializable;
use Stringable;

class Snowflake implements Stringable, JsonSerializable, Jsonable
{
    public readonly int $snowflake;

    public readonly string $binary;

    public readonly int $timestamp;

    public readonly int $worker;

    public readonly int $process;

    public readonly int $increment;

    public function __construct(int $snowflake)
    {
        if ($snowflake <= 0 || $snowflake > PHP_INT_MAX) {
            throw new InvalidArgumentException('Invalid Snowflake ID');
        }

        $this->snowflake = $snowflake;
        $this->binary = str_pad(decbin($snowflake), 64, '0', STR_PAD_LEFT);
        $this->timestamp = bindec(substr($this->binary, 0, 42)) + 1420070400000;
        $this->worker = bindec(substr($this->binary, 42, 5));
        $this->process = bindec(substr($this->binary, 47, 5));
        $this->increment = bindec(substr($this->binary, 52, 12));
    }

    public function timestamp(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestampMsUTC($this->timestamp);
    }

    public function jsonSerialize(): string
    {
        return $this->snowflake;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR | $options);
    }

    public function __toString(): string
    {
        return $this->snowflake;
    }
}
