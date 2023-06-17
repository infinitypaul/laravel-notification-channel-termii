<?php

namespace Infinitypaul\Termii\Test;

use Infinitypaul\Termii\TermiiServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [TermiiServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
