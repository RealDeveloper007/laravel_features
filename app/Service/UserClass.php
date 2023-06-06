<?php

/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repository\UserRepository;
use App\Models\User;

class UserClass implements UserRepository
{
    public function listAll()
    {
        return User::paginate(10);
    }
}
