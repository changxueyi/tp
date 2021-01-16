<?php

use think\facade\Route;

Route::rule("test", "demo/index/hello", "GET");
//直接访问：http://127.0.0.1/test 则输出{"status":-4,"message":"控制器不存在","result":null}

//容易踩的坑，但是我们因为是在demo模块下的，我们可以直接使用http://127.0.0.1/demo/test，test前面加上demo就可以直接使用了

//Route::rule("demo/test", "demo/index/hello", "GET");假定路由test前再加上一个test,我们就可以使用http://127.0.0.1/demo/demo/test 访问了


