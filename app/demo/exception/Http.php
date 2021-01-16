<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/16 20:54
 */

namespace app\demo\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle
{
    public $httpStatus = 500;

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        //自己定义的异常处理机制
        // 添加自定义异常处理机制,核心中的核心，太重要了,好好的抓住这个要点信息
        //return show(config("status.error"), $e->getMessage());
        return show(config("status.error"), $e->getMessage(),[],$this->httpStatus);
    }

}