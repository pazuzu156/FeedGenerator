<?php

namespace Pazuzu156\FeedGenerator\Scara;

use Scara\Support\Facades\Facade;

/**
 * Generator's  facade.
 */
class FeedGeneratorFacade extends Facade
{
    /**
     * Registers the Generator's facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'feedgenerator';
    }
}
