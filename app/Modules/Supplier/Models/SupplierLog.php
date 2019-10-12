<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 23:18
 */

namespace App\Modules\Supplier\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierLog extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}