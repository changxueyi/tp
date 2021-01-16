<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/16 17:32
 */

namespace app\demo\controller;

use app\BaseController;
use app\model\User;

class M extends BaseController
{
    public function index()
    {
        $id = $this->request->param("id", 0, "intval");
        if (empty($id)) {
            return show(config("status.error", "参数错误"));
        }

        //库里拿数据
        $results = User::find($id);
        if (empty($results)) {
            return show("404", "数据为空11111111111111","changxueyi");
        }
        return show(config("status.success"), "ok", $results);

        //如果直接访问http://127.0.0.1/demo/m/index，则返回{"status":0,"message":"error","result":[]}，所以URL中必须带上参数

        //访问http://127.0.0.1/demo/m/index?id=45，则会返回{"status":1,"message":"ok","result":{"id":45,"username":"传智播客","birthday":"2018-03-04 12:04:06","sex":"男","address":"北京金燕龙"}}


    }
}