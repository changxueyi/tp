<?php
namespace app\admin\controller;
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/20 20:45
 */
use app\BaseController;
use think\exception\HttpResponseException;

class AdminBase extends BaseController
{
    public $adminUser = null;

    public function initialize()
    {
        parent::initialize();
        //判断是否登录，判断是否登录，切换到 中间件Auth中
        //if(empty($this->isLogin()){
        // return $this->redirect(url("login/index"),302);
        //}
    }

    /***
     * 判断是否登录
     */
    public function isLogin()
    {
        $this->adminUser = session(config("admin.session_admin"));
    }

    public function redirect(...$args) {
        throw new HttpResponseException(redirect(...$args));
    }

}