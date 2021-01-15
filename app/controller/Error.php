<?php

namespace app\controller;

class Error
{
    public function __call($name, $arguments)
    {
        $result = [
            //注意：因为引用的是status.php文件，所以，调用的时候，一定要加上前缀status
            'status' => config("status.controller_not_found"),
            'message' => "控制器不存在",
            'result' => null,
        ];
        return json($result, 400);
        //注意下面的连接加不加:端口号都可以的哈
        //当我们去访问：http://127.0.0.1/demo2/hello?show=12 ，则会返回{"status":0,"message":"控制器不存在","result":null}
        //当然我们是使用api的形式展现，也可以通过页面等其他的形式去展现出来
    }
}
