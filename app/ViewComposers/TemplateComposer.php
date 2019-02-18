<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/8
 * Time: 17:44
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class TemplateComposer
{
    protected $template_config;

    protected $url_path;

    protected $user;

    public function __construct()
    {
        $this->template_config = config('template');
        $this->url_path = Request::path();
        $this->user = Auth::user();
    }

    public function compose(View $view)
    {
        $view_name = $view->name();

        if ('layouts.header' == $view_name) {
            $view->with([
                'header_config' => $this->template_config['header'],
                'user' => $this->user,
            ]);
        }
        if ('layouts.sidebar' == $view_name) {
            $view->with([
                'menus' => $this->handleMenus($this->template_config['sidebar']['menus']),
            ]);
        }
        if ('layouts.footer' == $view_name) {
            $view->with(['footer_config' => $this->template_config['footer']]);
        }
    }

    public function handleMenus($menus)
    {
        $menus = json_decode(json_encode($menus));  // 转化成对象
        foreach ($menus as $menu) {
            $this->handleMenu($menu);
        }

        return $menus;
    }

    /**
     * 处理一个菜单
     *
     * @param $menu
     * @return bool 返回该菜单是否要展开
     */
    public function handleMenu($menu)
    {
        $is_active = false;

        if (isset($menu->menus)) {
            $menu->treeview = true;
            foreach ($menu->menus as $submenu) {
                $result = $this->handleMenu($submenu);
                if ($result) {
                    $is_active = $menu->is_active = true;
                }
            }
        }elseif (isset($menu->link) && '/' != $this->url_path && trim($menu->link, '/') == $this->url_path) {
            $is_active = $menu->is_active = true;
        }

        return $is_active;
    }
}