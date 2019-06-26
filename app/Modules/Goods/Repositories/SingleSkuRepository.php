<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 11:02
 */

namespace App\Modules\Goods\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Goods\Models\SingleSku;

class SingleSkuRepository extends BaseRepository
{
    public function model()
    {
        return SingleSku::class;
    }
}