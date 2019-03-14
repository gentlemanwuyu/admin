<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/13
 * Time: 20:06
 */

namespace App\Modules\Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Product\Models\Product;
use App\Traits\RepositoryTrait;

class ProductRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Product::class;
    }
}