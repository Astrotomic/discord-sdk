<?php

namespace Astrotomic\DiscordSdk\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Stringable;

class StringableCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): Stringable|Uncastable
    {
        /** @var class-string<Stringable>|null $type */
        $type = $property->type->findAcceptedTypeForBaseType(Stringable::class);

        if ($type === null) {
            return Uncastable::create();
        }

        return new $type($value);
    }
}
