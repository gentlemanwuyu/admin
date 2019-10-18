<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/18
 * Time: 16:38
 */

namespace App\Events;

class UserDeleted extends Event
{
    /**
     * 用户ID
     *
     * @var array
     */
    public $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
}