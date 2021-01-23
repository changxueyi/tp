<?php

/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/20 20:43
 */
namespace app\admin\controller;
use think\facade\View;
use app\common\model\mysql\AdminUser;
class Login extends AdminBase
{
    public function initialize()
    {
        if ($this->isLogin()) {
            return $this->redirect(url("index/index"));
        }
    }

    public function index()
    {
        //渲染模板输出
        return View::fetch();
    }

    //MD5加秘
    public function md5()
    {
        halt(session(config("admin.session_admin")));
        echo md5("admin_singwa_abc");
    }

    public function check()
    {
        if (!$this->request->isPost()) {
            return show(config("status.error"), "请求方式错误");
        }
        //参数校验  1. 原生方式 2. TP6验证机制
        $username = $this->request->param("username", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $captcha = $this->request->param("captcha", "", "trim");

        $data = [
            'username' => $username,
            'password' => $password,
            'captcha' => $captcha,
        ];
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->check($data)) {
            return show(config("status.error"), $validate->getError());
        }

        try {
            $result = (new \app\admin\business\AdminUser())->login($data);
        } catch (\Exception $e) {
            return show(config("status.error"), $e->getMessage());
        }
        if ($result) {
            return show(config("status.success"), "登录成功");
        } else {
            return show(config("status.error"), "登录失败");
        }
    }


}