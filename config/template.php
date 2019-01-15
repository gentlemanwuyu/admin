<?php
/**
 * 模板配置
 *
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/8
 * Time: 17:33
 */

return [
    'header' => [
        'logo-mini' => [
            'big' => 'A',
            'common' => 'LT',
        ],
        'logo-lg' => [
            'big' => 'Gentleman',
            'common' => 'Admin',
        ],
        'messages-menu' => [
            'show' => true,
        ],
        'notifications-menu' => [
            'show' => true,
        ],
        'tasks-menu' => [
            'show' => true,
        ],
        'language-menu' => [
            'show' => true,
        ],
        'user-menu' => [
            'show' => true,
        ],
        'control-sidebar' => [
            'show' => true,
        ],
    ],
    'sidebar' => [
        'menus' => [
            // 授权管理
            [
                'id' => 'auth_management',
                'icon' => 'fa fa-lock',
                'menus' => [
                    [
                        'id' => 'user_list',
                        'icon' => 'fa fa-users',
                        'link' => '/auth/auth/user_list',
                    ],
                ],
            ],
        ],
    ],
    'footer' => [
        'version' => '1.0.0',
        'start_year' => 2018,
        'end_year' => date('Y'),
    ],
];