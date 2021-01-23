<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/21 16:36
 */

namespace app\common\model\mysql;

use think\Model;

class AdminUser extends Model
{
    /**
     * @param $username 通过username进行查询
     * @return array|false|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminUserByUsername($username)
    {
        if (empty($username)) {
            return false;
        }
        $where = [
            "usernmae" => trim($username),
        ];
        $result = $this->where($where)->find();
        return $result;
    }

    public function updateById($id, $data)
    {
        $id = intval($id);
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }
        $where = [
            "id" => $id,
        ];
        return $this->where($where)->save($data);
    }

}