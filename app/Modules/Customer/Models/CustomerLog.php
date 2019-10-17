<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/17
 * Time: 14:01
 */

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}