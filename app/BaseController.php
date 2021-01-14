<?php
declare (strict_types=1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param App $app 应用对象
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {
    }

    /**
     * 验证数据
     * @access protected
     * @param array $data 数据
     * @param string|array $validate 验证器名或者验证规则数组
     * @param array $message 提示信息
     * @param bool $batch 是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    //健壮系统服务，杜绝无效请求，
    public function __call($name, $arguments)
    {
        //具体解释
        //var_dump（）函数用于输出变量的相关信息。
        //var_dump（）函数显示关于一个或多个表达式的结构信息，包括表达式的类型与值。数组将递归归零值，通过缩进显示其结构。
        //dump($name); //代表方法，
        //dump($arguments);//代表参数信息, 去访问
        //逻辑，如果我们是一个API模块，需要取输出API 格式，
        //     如果我们是一个模板引擎的模式，我们需输出一个错误页面

        //当输入连接http://127.0.0.1/demo/hello?show=12， 就会输出{"status":0,"message":"找不到对应的方法","result":null},
        // 因为上述操作是不存在的，注意，上面的URL 中，demo是一个php文件名字，是一个控制器
        //当输入控制器不存在的时候：http://127.0.0.1/demo2/hello?show=12
        //直接返回控制器不存在:app\controller\Demo2,
        //如何解决控制器不存在? 重新创建一个error控制器
        /* $result = [
             'status' => 0,
             'message' => "找不到该($name)方法",
             'result' => null,
         ];
         return json($result, 400);*/
        //上面的注释了，直接去调用common.php中的show方法

        //这里的status是业务中的状态,前端和后端一起来定义的，这个时候我们会面临到一个问题
        // 后端需要给前端一个状态,把状态码抽离，剥离出来
        return show(0, "找不到该($name)方法", null, 405);

    }

}
