<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/19
 * Time: 16:52
 */

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPaymentMethod extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function getPaymentMethodNameAttribute()
    {
        return isset(\Payment::$methods[$this->method_id]) ? \Payment::$methods[$this->method_id] : '';
    }
}