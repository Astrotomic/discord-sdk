<?php

namespace Astrotomic\DiscordSdk\Queries;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Repositories\ArrayStore;
use Stringable;

abstract class Query extends ArrayStore implements Arrayable
{
    public function __construct(array $data = [])
    {
        $data = array_map(
            callback: fn (mixed $value) => $value instanceof Stringable ? (string) $value : $value,
            array: $data,
        );

        parent::__construct($data);
    }

    public function toArray(): array
    {
        return $this->all();
    }
}
