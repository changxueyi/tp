<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/16 21:38
 */

namespace app\demo\middleware;

class Detail
{
    //使用中间件，一定要记得先配置，不然中间件不能生效
    public function handle($request, \Closure $next)
    {
        $request->type = "99999";
        //中间件可以处理分页的信息,拦截的信息等
        return $next($request);
    }

    /***
     * 中间件结束调度
     */
    public function end(\think\Response $response)
    {

    }
}