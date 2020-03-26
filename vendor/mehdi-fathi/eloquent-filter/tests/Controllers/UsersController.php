<?php

namespace Tests\Controllers;

use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Tests\Models\User;

/**
 * Class UsersController.
 */
class UsersController
{
    /**
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $filters
     *
     * @return mixed
     */
    public static function filterUser(ModelFilters $filters)
    {
        $users = User::filter($filters);

        return $users;
    }
}
