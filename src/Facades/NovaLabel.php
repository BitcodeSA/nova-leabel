<?php

namespace Bitcodesa\NovaLabel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bitcodesa\NovaLabel\NovaLabel
 */
class NovaLabel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Bitcodesa\NovaLabel\NovaLabel::class;
    }
}
