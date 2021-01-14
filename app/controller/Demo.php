<?php

namespace app\controller;

use app\BaseController;

class Demo extends BaseController
{
    public function show()
    {
        //return "changxueyi";
        //也可以通过JSON 形式进行输出
        $result = [
            "status" => 1,
            "code" => 200,
            "message" => ["id" => 1],
        ];
        $header = [
            "Token" => "e23gdagfjl"
        ];
        return json($result, 201, $header);
    }

    public function request()
    {
        //第一种获取参数的场景！！！
        //输出的一个方法,访问http://127.0.0.1/demo/request?abc=1&name=2
        //此处param 可以替换为get,但是如果是post则不可以

        //注意这里可以使用参数了，但是abc一定要记得添加上引号
        //http://127.0.0.1/demo/request?abc=1,注意key一定要加上引号,获取URL 数据的基本方法
        dump($this->request->param("abc", 1, "intval"));
    }
}
