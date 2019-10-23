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
                    [
                        'id' => 'role_list',
                        'icon' => 'fa fa-object-group',
                        'link' => '/entrust/role/list',
                    ],
                    [
                        'id' => 'permission_list',
                        'icon' => 'fa fa-street-view',
                        'link' => '/entrust/permission/list',
                    ],
                ],
            ],
            // 组织结构
            [
                'id' => 'organization_management',
                'icon' => 'fa fa-university',
                'menus' => [
                    [
                        'id' => 'department_chart',
                        'icon' => 'fa fa-sitemap',
                        'link' => '/organization/department/chart',
                    ],
                ],
            ],
            // 分类管理
            [
                'id' => 'category_management',
                'icon' => 'fa fa-tree',
                'menus' => [
                    [
                        'id' => 'category_tree',
                        'icon' => 'fa fa-tree',
                        'link' => '/category/category/index',
                    ],
                    [
                        'id' => 'category_attribute',
                        'icon' => 'fa fa-tree',
                        'link' => '/category/attribute/index',
                    ],
                ],
            ],
            // 产品管理
            [
                'id' => 'product_management',
                'icon' => 'fa fa-cubes',
                'menus' => [
                    [
                        'id' => 'product_list',
                        'icon' => 'fa fa-cube',
                        'link' => '/product/product/list',
                    ],
                ],
            ],
            // 商品管理
            [
                'id' => 'goods_management',
                'icon' => 'fa fa-cubes',
                'menus' => [
                    [
                        'id' => 'goods_list',
                        'icon' => 'fa fa-cube',
                        'link' => '/goods/goods/list',
                    ],
                ],
            ],
            // 供应商管理
            [
                'id' => 'supplier_management',
                'icon' => 'fa fa-street-view',
                'menus' => [
                    [
                        'id' => 'supplier_list',
                        'icon' => 'fa fa-street-view',
                        'link' => '/supplier/supplier/list',
                    ],
                    [
                        'id' => 'purchase_order_management',
                        'icon' => 'fa fa-newspaper-o',
                        'link' => '/supplier/order/list',
                    ],
                ],
            ],
            // 客户管理
            [
                'id' => 'customer_management',
                'icon' => 'fa fa-male',
                'menus' => [
                    [
                        'id' => 'my_customer',
                        'icon' => 'fa fa-male',
                        'link' => '/customer/customer/my_customer',
                    ],
                    [
                        'id' => 'black_list',
                        'icon' => 'fa fa-bomb',
                        'link' => '/customer/customer/black_list',
                    ],
                    [
                        'id' => 'customer_pool',
                        'icon' => 'fa fa-database',
                        'link' => '/customer/customer/customer_pool',
                    ],
                    [
                        'id' => 'customer_payment_method_application_list',
                        'icon' => 'fa fa-money',
                        'link' => '/customer/customer/payment_method_application_list',
                    ],
                ],
            ],
            // 系统管理
            [
                'id' => 'system_management',
                'icon' => 'fa fa-support',
                'menus' => [
                    [
                        'id' => 'running_log',
                        'icon' => 'fa fa-book',
                        'link' => '/logs',
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