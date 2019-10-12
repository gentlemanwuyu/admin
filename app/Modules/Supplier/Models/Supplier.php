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
        if (!$contacts || !is_array($contacts)) {
            return null;
        }

        $ids = array_keys($contacts);

        SupplierContact::where('supplier_id', $this->id)
            ->whereNotIn('id', $ids)->get()->map(function ($contact) {
                $contact->delete();
            });

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

    public function contacts()
    {
        return $this->hasMany(SupplierContact::class);
    }

    public function delete()
    {
        parent::delete();
        SupplierContact::where('supplier_id', $this->id)->delete();

        return true;
    }
}