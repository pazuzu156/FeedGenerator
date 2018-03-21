<?php

namespace Pazuzu156\FeedGenerator\Laravel;

use Illuminate\Support\Facades\Facade;

class FeedGeneratorFacade extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'feedgenerator';
    }
}
