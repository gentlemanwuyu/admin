<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/7/1
 * Time: 19:21
 */

namespace App\Modules\Goods\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SingleProduct extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}