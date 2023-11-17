<?php

namespace Astrotomic\DiscordSdk\Casts;

use Carbon\CarbonInterface;
use DateTimeZone;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Exceptions\CannotCastDate;
use Spatie\LaravelData\Support\DataProperty;

class CarbonInterfaceCast extends DateTimeInterfaceCast
{
    public function cast(DataProperty $property, mixed $value, array $context): CarbonInterface|Uncastable
    {
        $type = $this->type ?? $property->type->findAcceptedTypeForBaseType(CarbonInterface::class);

        if ($type === null) {
            return Uncastable::create();
        }

        /** @var CarbonInterface|null $datetime */
        $datetime = rescue(fn () => $type::parse($value), report: false);

        if (! $datetime) {
            throw CannotCastDate::create(['*'], $type, $value);
        }

        if ($this->setTimeZone) {
            return $datetime->setTimezone(new DateTimeZone($this->setTimeZone));
        }

        return $datetime;
    }
}
