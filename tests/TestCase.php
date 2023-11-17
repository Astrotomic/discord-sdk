<?php

namespace Tests;

use Astrotomic\DiscordSdk\DiscordConnector;
use Astrotomic\DiscordSdk\DiscordSdkServiceProvider;
use Illuminate\Support\Arr;
use Orchestra\Testbench\TestCase as Orchestra;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Faking\Fixture;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use Saloon\Laravel\Facades\Saloon;

abstract class TestCase extends Orchestra
{
    protected $enablesPackageDiscoveries = true;

    protected function setUp(): void
    {
        parent::setUp();

        Saloon::fake([
            DiscordConnector::class => function (PendingRequest $request): Fixture {
                $name = implode('/', array_filter([
                    parse_url($request->getUrl(), PHP_URL_HOST),
                    $request->getMethod()->value,
                    parse_url($request->getUrl(), PHP_URL_PATH),
                    Arr::query(collect($request->query()->all())->sortKeys()->all()),
                ]));

                return MockResponse::fixture($name);
            },
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            DiscordSdkServiceProvider::class,
        ];
    }

    protected function discord(Authenticator $authenticator): DiscordConnector
    {
        return new DiscordConnector($authenticator);
    }
}
