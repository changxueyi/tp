<?php

namespace app\admin\controller;
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/20 23:36
 */
class Logout extends AdminBase
{
    public function index()
    {
        session(config("admin,session_admin"), null);
        //执行跳转
        return redirect(url("login/index"));
    }
}