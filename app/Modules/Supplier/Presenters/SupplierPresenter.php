<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 15:04
 */

namespace App\Modules\Supplier\Presenters;

class SupplierPresenter
{
    public function showContact($contact)
    {
        $info = $contact->name;
        if (!empty($contact->position)) {
            $info .= '(' . $contact->position . ')';
        }

        if (!empty($contact->phone_number)) {
            $info .= ', ' . $contact->phone_number;
        }

        return $info;
    }
}