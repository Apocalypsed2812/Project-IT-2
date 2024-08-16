<?php

namespace App\Repos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SyncRepositoryInterface extends EloquentRepositoryInterface {
    public function getTokenSF();
    public function getDataFromObjectname(string $objectName, string $fields);
}
