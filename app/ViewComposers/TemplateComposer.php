<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/8
 * Time: 17:44
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

class TemplateComposer
{
    protected $template_config;

    public function __construct()
    {
        $this->template_config = config('template');
    }

    public function compose(View $view)
    {
        $view_name = $view->name();

        if ('layouts.header' == $view_name) {
            $view->with(['header_config' => $this->template_config['header'],]);
        }
        if ('layouts.footer' == $view_name) {
            $view->with(['footer_config' => $this->template_config['footer']]);
        }
    }
}