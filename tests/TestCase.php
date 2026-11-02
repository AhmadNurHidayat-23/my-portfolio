<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->resetHttpFake([
            'https://api.github.com/users/*/repos*' => Http::response([], 403),
            'https://api.github.com/users/*' => Http::response(['public_repos' => 19], 200),
            'https://api.github.com/*' => Http::response([], 403),
        ]);
    }

    /**
     * @param  array<string, mixed>  $stubs
     */
    protected function resetHttpFake(array $stubs): void
    {
        $factory = new HttpFactory;
        $this->app->instance(HttpFactory::class, $factory);
        Http::swap($factory);
        Http::fake($stubs);
    }
}
