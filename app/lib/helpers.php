<?php
/**
 * 自定义辅助函数
 *
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/10
 * Time: 20:08
 */

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Generator as Faker;

if (! function_exists('module_path')) {
    /**
     * 获取模块根路径
     *
     * @param $module
     * @return string
     */
    function module_path($module)
    {
        return app_path().DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.studly_case($module);
    }
}

if (! function_exists('module_factory')) {
    /**
     * 获取模块工厂对象
     *
     * @param $module
     * @return object
     */
    function module_factory($module)
    {
        $pathToFactories = module_path($module).DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'Factories';
        $factory = EloquentFactory::construct(app(Faker::class), $pathToFactories);

        $arguments = func_get_args();

        if (isset($arguments[2]) && is_string($arguments[2])) {
            return $factory->of($arguments[1], $arguments[2])->times($arguments[3] ?? null);
        } elseif (isset($arguments[2])) {
            return $factory->of($arguments[1])->times($arguments[2]);
        }

        return $factory->of($arguments[1]);
    }
}