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
use App\Models\Country;
use App\Models\ChineseRegion;

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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'abbreviation');
    }

    public function getFullAddressAttribute()
    {
        if ('CN' != $this->country_code) {
            return $this->address;
        }

        $full_address = '';
        if ($this->state) {
            $full_address .= $this->state->name;
        }
        if ($this->city) {
            $full_address .= $this->city->name;
        }
        if ($this->county) {
            $full_address .= $this->county->name;
        }
        $full_address .= $this->street_address;

        return $full_address;
    }

    public function state()
    {
        return $this->belongsTo(ChineseRegion::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(ChineseRegion::class, 'city_id');
    }

    public function county()
    {
        return $this->belongsTo(ChineseRegion::class, 'county_id');
    }

    public function logs()
    {
        return $this->hasMany(SupplierLog::class)->orderBy('id', 'desc');
    }
}