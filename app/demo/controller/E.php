<?php
/**
 * @Description TODO 控制层去
 * @Author changxueyi
 * @Date 2021/1/16 20:39
 */

namespace app\demo\controller;

use app\BaseController;

class E extends BaseController
{
    public function index()
    {
        //echo "没有躺赢的命，那就站起来跑";
        /*echo $ab;*/
        throw new \think\exception\HttpException(404, "找不到相应数据");
        //上面的状态码是501不是自己想要的
    }

    public function abc()
    {
        dump($this->request->type());
    }
}