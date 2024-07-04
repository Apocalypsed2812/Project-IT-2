<?php

namespace App\Repos\Eloquent;

use App\Models\Account;
use Carbon\Carbon;
use App\Repos\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
    }
}
