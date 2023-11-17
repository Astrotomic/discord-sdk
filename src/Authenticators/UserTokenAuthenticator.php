<?php

namespace Astrotomic\DiscordSdk\Authenticators;

use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class UserTokenAuthenticator implements Authenticator
{
    public function __construct(

        protected readonly string $token,
    ) {
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('Authorization', 'Bearer '.$this->token);
    }
}
