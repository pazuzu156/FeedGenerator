<?php

namespace Pazuzu156\FeedGenerator\Scara;

use Pazuzu156\FeedGenerator\Generator;
use Scara\Support\ServiceProvider;

/**
 * Generator's Service Provider.
 */
class FeedGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Registers the Generator's service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->create('feedgenerator', function () {
            return new Generator();
        });
    }
}
