<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/19
 * Time: 14:29
 */

namespace App\Modules\Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Product\Models\ProductSkuAttributeValue;
use App\Traits\RepositoryTrait;

class ProductSkuAttributeValueRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return ProductSkuAttributeValue::class;
    }
}