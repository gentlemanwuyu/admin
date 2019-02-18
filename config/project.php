<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/9
 * Time: 14:41
 */

return [
    // 项目名称
    'name' => 'Gentleman Admin',

    // 公司名字
    'company_name' => '深圳市欣汉生科技有限公司',

    // 创建用户时的默认密码
    'default_password' => 'admin',

    // 是否检查权限
    'check_entrust' => env('CHECK_ENTRUST') ? true : false,
];