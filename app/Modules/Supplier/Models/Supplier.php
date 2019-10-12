<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 8:53
 */

namespace App\Modules\Supplier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * 同步联系人
     *
     * @param $contacts
     */
    public function syncContacts($contacts)
    {
        foreach ($contacts as $id => $item) {
            $contact = SupplierContact::find($id);
            if ($contact) {
                $contact->update($item);
            }else {
                $item['supplier_id'] = $this->id;
                SupplierContact::create($item);
            }
        }
    }
}