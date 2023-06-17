<?php

namespace Infinitypaul\Termii;

use Illuminate\Support\ServiceProvider;
use Infinitypaul\Termii\Termii;
use Infinitypaul\Termii\TermiiChannel;

class TermiiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        $this->app->when(TermiiChannel::class)
            ->needs(Termii::class)
            ->give(function () {
                return new Termii();
            });

    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
