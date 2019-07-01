<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 11:01
 */

namespace App\Modules\Goods\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsSku extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}