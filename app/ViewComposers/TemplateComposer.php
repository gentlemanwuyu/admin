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

    /**
     * 处理菜单
     *
     * @param $menus
     * @return mixed
     */
    public function handleMenus($menus)
    {
        $menus = json_decode(json_encode($menus));  // 转化成对象
        foreach ($menus as $key => $menu) {
            if (isset($menu->menus)) {
                $menu->treeview = true;
                $menu = $this->handleTreeview($menu);
            }else {
                $menu = $this->handleLink($menu);
            }
            if (!$menu) {
                unset($menus[$key]);
            }
        }

        return $menus;
    }

    /**
     * 处理链接型菜单
     *
     * @param $menu
     * @return mixed bool|object
     */
    public function handleLink($menu)
    {
        // 没有权限直接返回false
        if (!$this->user->can($menu->id)) {
            return false;
        }
        if (isset($menu->link) && '/' != $this->url_path && trim($menu->link, '/') == $this->url_path) {
            $menu->is_active = true;
        }

        return $menu;
    }

    /**
     * 处理treeview型菜单
     *
     * @param $menu
     * @return null
     */
    public function handleTreeview($menu)
    {
        foreach ($menu->menus as $sub_key => $sub_menu) {
            if (isset($sub_menu->menus)) {
                $sub_menu->treeview = true;
                $sub_menu = $this->handleTreeview($sub_menu);
            }else {
                $sub_menu = $this->handleLink($sub_menu);
            }
            // 子菜单没有权限
            if (!$sub_menu) {
                unset($menu->menus[$sub_key]);
            }
            // 如果子菜单active，则父菜单展开
            if (!empty($sub_menu->is_active)) {
                $menu->is_active = true;
            }
        }
        if (empty($menu->menus)) {
            return null;
        }

        return $menu;
    }
}