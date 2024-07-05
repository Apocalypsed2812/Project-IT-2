<?php

namespace App\Repos\Eloquent;

use App\Models\Product;
use Carbon\Carbon;
use App\Repos\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
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
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
