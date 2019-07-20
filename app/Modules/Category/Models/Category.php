<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/20
 * Time: 15:38
 */

namespace App\Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    static $types = [
        1 => 'product',
        2 => 'goods',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}