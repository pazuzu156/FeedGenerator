<?php

namespace Pazuzu156\FeedGenerator\Laravel;

use Illuminate\Support\ServiceProvider;
use Pazuzu156\FeedGenerator\Generator;

class FeedGeneratorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->app->singleton('feedgenerator', function($app) {
            return new Generator();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function provides()
    {
        return ['feedgenerator'];
    }
}
