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
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    static $statuses = [
        1 => 'padding',
        2 => 'agreed',
        3 => 'rejected',
        4 => 'closed',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getPaymentMethodNameAttribute()
    {
        return isset(\Payment::$methods[$this->method_id]) ? \Payment::$methods[$this->method_id] : '';
    }

    public function getStatusNameAttribute()
    {
        return isset(self::$statuses[$this->status]) ? self::$statuses[$this->status] : '';
    }
}