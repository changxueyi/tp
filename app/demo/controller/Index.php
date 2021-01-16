<?php

namespace app\demo\controller;

use app\BaseController;

class Index extends BaseController
{
    public function abc()
    {
        return 1234567;
    }

    public function hello()
    {
        return time();
    }
}

