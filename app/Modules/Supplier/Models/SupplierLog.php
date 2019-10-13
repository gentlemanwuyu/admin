<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 23:18
 */

namespace App\Modules\Supplier\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Auth\Models\User;
use App\Services\WorldService;

class SupplierLog extends Model
{
    static $actions = [
        1 => 'create',
        2 => 'update',
        3 => 'black',
        4 => 'release',
        5 => 'delete',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getActionNameAttribute()
    {
        return isset(self::$actions[$this->action]) ? self::$actions[$this->action] : '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getContentAttribute()
    {
        if (in_array($this->action, [1, 2])) {
            $content = [];
            $message = json_decode($this->message, true);
            if (isset($message['name'])) {
                $content[] = trans('application.name') . ': ' . $message['name'];
            }
            if (isset($message['code'])) {
                $content[] = trans('supplier::supplier.supplier_code') . ': ' . $message['code'];
            }
            if (isset($message['company'])) {
                $content[] = trans('application.company') . ': ' . $message['company'];
            }
            if (isset($message['introduction'])) {
                $content[] = trans('application.introduction') . ': ' . $message['introduction'];
            }
            if (isset($message['phone_number'])) {
                $content[] = trans('application.phone') . ': ' . $message['phone_number'];
            }
            if (isset($message['fax'])) {
                $content[] = trans('application.fax') . ': ' . $message['fax'];
            }
            if (isset($message['country_code'])) {
                $countries = WorldService::countries();
                $content[] = trans('application.country') . ': ' . $countries[$message['country_code']]['zh_name'];
            }

            // 地址
            if ('CN' != $message['country_code']) {
                $content[] = trans('application.address') . ': ' . $message['address'];
            }else {
                $address = '';
                $chinese_regions = WorldService::chineseTree();
                if (!empty($message['state_id'])) {
                    $address .= $chinese_regions[$message['state_id']]['name'];
                }
                if (!empty($message['city_id'])) {
                    $address .= $chinese_regions[$message['state_id']]['children'][$message['city_id']]['name'];
                }
                if (!empty($message['county_id'])) {
                    $address .= $chinese_regions[$message['state_id']]['children'][$message['city_id']]['children'][$message['county_id']]['name'];
                }
                $address .= $message['street_address'];
                $content[] = trans('application.address') . ': ' . $address;
            }

            // 联系人
            if (isset($message['contacts'])) {
                $first = true;
                foreach ($message['contacts'] as $contact) {
                    $info = '';
                    $info .= $contact['name'];
                    if ($contact['position']) {
                        $info .= "({$contact['position']})";
                    }
                    if ($contact['phone_number']) {
                        $info .= ", {$contact['phone_number']}";
                    }
                    if ($first) {
                        $content[] = trans('application.contact') . ': ' . $info;
                        $first = false;
                    }else {
                        $content[] = str_repeat('&nbsp;', 17) . $info;
                    }
                }
            }

            return implode('<br/>', $content);
        }

        return $this->message;
    }
}