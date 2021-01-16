<?php

namespace app\common\model\mysql;

use think\Model;

/**
 * Class User PHP 中的模型层，类似与一个Dao层的一个概念，直接可以接触到数据库的那种
 * @package app\model
 */
class User extends Model
{
    //模型层的数据调用转换，类似于作为一个Dao层的存在
    public function getDemoDataById($id)
    {
        if (empty($id)) {
            return [];
        }
        $results = User::find($id);
        return $results;
    }
}
