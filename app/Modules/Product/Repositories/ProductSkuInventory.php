<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/4
 * Time: 0:53
 */

namespace App\Modules\Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Product\Models\ProductSkuInventory;
use App\Traits\RepositoryTrait;

class ProductSkuInventoryRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return ProductSkuInventory::class;
    }
}