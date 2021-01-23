<?php
/**
 * @Description TODO
 * @Author changxueyi
 * @Date 2021/1/16 21:40
 */

namespace app\demo\controller;

use app\BaseController;

class Detail extends BaseController
{
    public function index()
    {
        dump($this->request->type());
    }

    public function abc()
    {
        dump($this->request->type());
    }
}