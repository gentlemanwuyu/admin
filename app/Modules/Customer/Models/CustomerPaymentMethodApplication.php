<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/19
 * Time: 17:40
 */

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPaymentMethodApplication extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}