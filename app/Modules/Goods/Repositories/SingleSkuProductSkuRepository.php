<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/7/1
 * Time: 19:54
 */

namespace App\Modules\Goods\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Goods\Models\SingleSkuProductSku;

class SingleSkuProductSkuRepository extends BaseRepository
{
    public function model()
    {
        return SingleSkuProductSku::class;
    }
}