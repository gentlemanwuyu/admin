<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/11
 * Time: 16:11
 */

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}