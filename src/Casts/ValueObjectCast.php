<?php

namespace Astrotomic\DiscordSdk\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\DataProperty;
use Stringable;

class ValueObjectCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): Stringable|Uncastable
    {
        $type = $property->type->findAcceptedTypeForBaseType(Stringable::class);

        if ($type === null) {
            return Uncastable::create();
        }

        return new $type($value);
    }
}
