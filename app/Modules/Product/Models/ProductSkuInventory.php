<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/4
 * Time: 0:52
 */

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSkuInventory extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}