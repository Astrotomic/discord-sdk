<?php

namespace Astrotomic\DiscordSdk\Authenticators;

use Saloon\Contracts\Authenticator;
use Saloon\Contracts\PendingRequest;

class BotTokenAuthenticator implements Authenticator
{
    public function __construct(

        protected readonly string $token,
    ) {
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('Authorization', 'Bot '.$this->token);
    }
}
