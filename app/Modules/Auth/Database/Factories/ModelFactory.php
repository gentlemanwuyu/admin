<?php
/**
 * Auth模块的模型工厂
 *
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/11
 * Time: 11:26
 */

$factory->define(\App\Modules\Auth\Models\User::class, function (\Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => $password ?: $password = bcrypt('gentleman'),
        'birthday'       => $faker->date(),
        'gender_id'         => mt_rand(0, 2),
        'remember_token' => str_random(10),
    ];
});