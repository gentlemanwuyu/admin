<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 11:02
 */

namespace App\Modules\Goods\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Goods\Models\GoodsSku;

class GoodsSkuRepository extends BaseRepository
{
    public function model()
    {
        return GoodsSku::class;
    }
}