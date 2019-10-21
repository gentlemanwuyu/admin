<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/21
 * Time: 19:54
 */

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSkuActualInventoryLog extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}