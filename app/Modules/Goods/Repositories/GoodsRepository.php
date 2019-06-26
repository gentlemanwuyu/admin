<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 10:57
 */

namespace App\Modules\Goods\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Goods\Models\Goods;

class GoodsRepository extends BaseRepository
{
    public function model()
    {
        return Goods::class;
    }
}