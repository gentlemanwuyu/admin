<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/7/1
 * Time: 19:29
 */

namespace App\Modules\Goods\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Goods\Models\SingleProduct;

class SingleProductRepository extends BaseRepository
{
    public function model()
    {
        return SingleProduct::class;
    }
}