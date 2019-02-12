<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/11
 * Time: 17:56
 */

namespace App\Modules\Entrust\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $guarded = [];

    protected $types = [
        1 => 'menu',
        2 => 'action',
    ];

    public function getTypeAttribute()
    {
        return $this->types[$this->type_id] ?? 'unknown';
    }

    public function getTypes()
    {
        return $this->types;
    }
}