<?php

/*
 * UserRepository.php
 * Repository for managing users db access in the application.
 * Author: Juan Avendaño
*/

namespace App\Repositories;

// App
use App\Models\User;

class UserRepository extends BaseRepository
{
    protected string $model = User::class;

    protected array $with = [];
}
