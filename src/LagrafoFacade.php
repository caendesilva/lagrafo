<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DeSilva\Lagrafo\Skeleton\SkeletonClass
 */
class LagrafoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lagrafo';
    }
}
