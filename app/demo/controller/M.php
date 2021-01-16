<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/16 17:32
 */

namespace app\demo\controller;

use app\BaseController;
use app\common\model\mysql\User;

/**
 * Class M 这里的控制器层类似于Controller概念
 * @package app\demo\controller
 */
class M extends BaseController
{
    public function index()
    {
        $id = $this->request->param("id", 0, "intval");
        if (empty($id)) {
            return show(config("status.error", "参数错误"));
        }

        //创建一个模型层的对象,这里的new 就相当于一个依赖注入的感觉，拿到了User的model对象
        //PHP6 中的依赖注入就是new User();
        $model = new User();
        //调用模型层中的方法，类似于java中的依赖注入
        $results = $model->getDemoDataById($id);
        /*
                //库里拿数据
                $results = User::find($id);*/
        if (empty($results)) {
            return show("404", "数据为空11111111111111", "changxueyi");
        }
        return show(config("status.success"), "ok", $results);

        //如果直接访问http://127.0.0.1/demo/m/index，则返回{"status":0,"message":"error","result":[]}，所以URL中必须带上参数

        //访问http://127.0.0.1/demo/m/index?id=45，则会返回{"status":1,"message":"ok","result":{"id":45,"username":"传智播客","birthday":"2018-03-04 12:04:06","sex":"男","address":"北京金燕龙"}}

        //http://127.0.0.1/demo/m/index?id=41，{"status":1,"message":"ok","result":{"id":41,"username":"老王","birthday":"2018-02-27 17:47:08","sex":"男","address":"北京"}}
    }
}