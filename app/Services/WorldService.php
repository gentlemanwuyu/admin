<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 10:02
 */

namespace App\Services;

use Wuyu\World\Facades\World;
use Illuminate\Support\Facades\Redis;

class WorldService
{

    public function __construct()
    {

    }

    public static function chineseTree($parent_id = 0)
    {
        if ($tree = Redis::get('admin:world:chinese_tree_' . $parent_id)) {
            $tree = json_decode($tree, true);
            return $tree;
        }

        $tree = World::chineseTree($parent_id);
        Redis::setnx('admin:world:chinese_tree_' . $parent_id, json_encode($tree));

        return $tree;
    }

    public static function countries()
    {
        $countries = Redis::get('admin:world:countries');
        if ($countries) {
            return json_decode($countries, true);
        }

        $countries = World::countries();
        Redis::setnx('admin:world:countries', json_encode($countries));

        return $countries;
    }
}