<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/21 19:53
 */

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'name' => 'require',
        'pid' => 'require',
    ];

    protected $message = [
        'name' => '分类名称必须',
        'pid' => '父类ID必须',
    ];
}