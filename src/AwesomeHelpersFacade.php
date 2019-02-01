<?php

namespace Calebporzio\AwesomeHelpers;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Calebporzio\AwesomeHelpers\Skeleton\SkeletonClass
 */
class AwesomeHelpersFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'awesome-helpers';
    }
}
