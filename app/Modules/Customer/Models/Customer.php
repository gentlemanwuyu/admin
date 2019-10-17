<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/16
 * Time: 20:15
 */

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Customer\Models\CustomerContact;

class Customer extends Model
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

        CustomerContact::where('customer_id', $this->id)
            ->whereNotIn('id', $ids)->get()->map(function ($contact) {
                $contact->delete();
            });

        foreach ($contacts as $id => $item) {
            $contact = CustomerContact::find($id);
            if ($contact) {
                $contact->update($item);
            }else {
                $item['customer_id'] = $this->id;
                CustomerContact::create($item);
            }
        }
    }

    public function contacts()
    {
        return $this->hasMany(CustomerContact::class);
    }
}