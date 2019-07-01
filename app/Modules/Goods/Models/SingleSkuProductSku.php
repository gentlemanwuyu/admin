<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/7/1
 * Time: 19:24
 */

namespace App\Modules\Goods\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SingleSkuProductSku extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}