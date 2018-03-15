<?php

namespace Bantenprov\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The User facade.
 *
 * @package Bantenprov\User
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class UserFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user';
    }
}
