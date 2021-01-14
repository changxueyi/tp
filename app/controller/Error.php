<?php

namespace app\controller;

class Error
{
    public function __call($name, $arguments)
    {
        $result = [
            'status' => 0,
            'message' => "控制器不存在",
            'result' => null,
        ];
        return json($result, 400);
        //注意下面的连接加不加:端口号都可以的哈
        //当我们去访问：http://127.0.0.1/demo2/hello?show=12 ，则会返回{"status":0,"message":"控制器不存在","result":null}
        //当然我们是使用api的形式展现，也可以通过页面等其他的形式去展现出来
    }
}
