<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/19
 * Time: 11:55
 */

namespace App\Modules\Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Product\Models\ProductSku;
use App\Traits\RepositoryTrait;

class ProductSkuRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return ProductSku::class;
    }
}