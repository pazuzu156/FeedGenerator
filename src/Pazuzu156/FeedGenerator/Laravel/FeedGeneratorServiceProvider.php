<?php

namespace Pazuzu156\FeedGenerator\Laravel;

use Illuminate\Support\ServiceProvider;
use Pazuzu156\FeedGenerator\Generator;

class FeedGeneratorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton('feedgenerator', function ($app) {
            return new Generator();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return ['feedgenerator'];
    }
}
