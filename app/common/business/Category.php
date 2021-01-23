<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/21 19:25
 */

namespace app\common\business;

use app\common\model\mysql\Category as CategoryModel;

class Category
{
    public $model = null;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function add($data)
    {
        //TODO 这行代码是什么意思
        $data['status'] = config("status.mysql.table_normal");
        $name = $data['name'];
        //根据$name 去数据库查询是否存在这条记录，这个留给大家
        try {
            $this->model->save($data);
        } catch (\Exception $e) {
            throw new \think\Exception("服务内部异常");
        }
        //返回一个ID信息
        return $this->model->id;
    }

    public function getNormalCategorys()
    {
        $field = "id,name,pid";
        $categorys = $this->model->getNormalCategorys($field);
        if (!$categorys) {
            return $categorys;
        }
        //TODO 这里为什么要转数组
        $categorys = $categorys->toArray();
        return $categorys;

    }

    public function getNormalAllCategorys()
    {
        $field = "id as category_id,name,pid";
        $categorys = $this->model->getNormalCategorys($field);
        if (!$categorys) {
            return $categorys;
        }
        $categorys = $categorys->toArray();
        return $categorys;
    }

    public function getLists($data, $num)
    {
        $list = $this->model->getLists($data, $num);
        if (!$list) {
            return [];
        }

        $result = $list->toArray();
        //render()分页操作,TODO 这里是什么意思?
        $result['render'] = $list->render();
        //以下为同学们解读代码
        //思路：第一步拿到列表中id,第二步，in mysql
        $pids = array_column($result['data'], "id");
        if ($pids) {
            $idCountResult = $this->model->getChildCountInPids(['pid' => $pids]);
            //TODO 这里的代码省去一万行
        }

        return $result;
    }

    /***
     * 根据id获取某一条记录，提供好的代码,
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            return [];
        }
        $result = $result->toArray();
        return $result;
    }


    public function listorder($id, $listorder)
    {
        //查询,id这条数据是否存在
        $res = $this->getById($id);
        if (!$res) {
            throw new \think\Exception("不存在这条记录");
        }
        $data = [
            "listorder" => $listorder,
        ];

        try {
            $res = $this->model->updateById($id, $data);
        } catch (\Exception $e) {
            //记得记录日志
            return false;
        }
    }

    /**
     * 修改状态
     */
    public function status($id, $status)
    {
        //查询, id就是这条数据是否存在
        $res = $this->getById($id);
        if (!$res) {
            throw new \think\Exception("不存在该条记录");
        }
        if ($res['status'] == $status) {
            throw new \think\Exception("状态修改前和修改后一样，没有任何意义哈");
        }
        $data = [
            //TODO 这里的intval什么意思
            "status" => intval($status),
        ];
        try {
            $res = $this->model->updateById($id, $data);
        } catch (\Exception $e) {
            return false;
        }
        return $res;
    }

    /**
     * 获取一级分类的内容 代码提供好的 带同学们解读下 @9-5
     * @return array
     */
    public function getNormalByPid($pid = 0, $field = "id, name, pid")
    {
        //$field = "id,name,pid";
        try {
            $res = $this->model->getNormalByPid($pid, $field);
        } catch (\Exception $e) {
            // 记得记录日志。
            return [];
        }
        $res = $res->toArray();

        return $res;
    }
}
