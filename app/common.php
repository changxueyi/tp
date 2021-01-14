<?php
// 应用公共文件

/**
 * 通用化API数据格式化输出
 * @param $status
 * @param string $message
 * @param array $data
 * @param int $httpStatus
 * @return \think\response\Json
 */
//status 业务状态码，后台传给前端的状态码
//简单的事情左到极致化，是通用化，API数据格式数据
function show($status, $message = "error", $data = [], $httpStatus = 200)
{
    $result = [
        "status" => $status,
        'message' => $message,
        'result' => $data
    ];
    return json($result, $httpStatus);
}
