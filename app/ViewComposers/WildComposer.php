<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/9
 * Time: 15:40
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class WildComposer
{
    protected $project_config;

    public function __construct()
    {
        $this->project_config = config('project');
    }

    public function compose(View $view)
    {
        $view->with([
            'project_name' => $this->project_config['name'] ?: 'Gentleman Admin',
            'user' => Auth::user(),
        ]);
        // 每个模板都带着所有的请求参数
        $view->with(request()->all());
    }
}