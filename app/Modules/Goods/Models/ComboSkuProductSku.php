<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/7/4
 * Time: 15:37
 */

namespace App\Modules\Goods\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboSkuProductSku extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}