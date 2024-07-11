<?php

namespace App\Repos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AccountRepositoryInterface extends EloquentRepositoryInterface {
    public function getAccountByUsername(string $username);
}
