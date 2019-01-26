<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/26
 * Time: 15:54
 */

namespace App\Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}