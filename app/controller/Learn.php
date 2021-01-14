<?php

namespace app\controller;

use app\Request;
use think\facade\Request as abc;

//此处把Request,替换为abc

//门面模式

class Learn
{
    public function index(Request $request)
    {
        //下面的param 可以替换为get 等
        //第二种方式,!!!  http://127.0.0.1/learn/index?abc=1
        dump($request->param("abc"));
        //第三种获取方式 http://127.0.0.1/learn/index?abc=1
        dump(input("abc"));
        //第四种方式 http://127.0.0.1/learn/index?abc=1
        dump(request()->param("abc"));


        //第五种方法
        dump(abc::param("abc"));

        $request->isPost();
        $request->isAjax();
        $request->isGet();
    }
}
