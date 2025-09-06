<?php

namespace Astrotomic\DiscordSdk\Casts;

use Carbon\CarbonInterface;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Exceptions\CannotCastDate;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class CarbonInterfaceCast extends DateTimeInterfaceCast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): CarbonInterface|Uncastable
    {
        /** @var class-string<CarbonInterface>|null $type */
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
            return $datetime->setTimezone($this->setTimeZone);
        }

        return $datetime;
    }
}
