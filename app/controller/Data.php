<?php

namespace app\Controller;

use app\BaseController;
use http\Message\Body;
use think\facade\Db;

//TP 6 必须要加入facade，我们还可以通过容器的方式来获取数据,门面模式
class Data extends BaseController
{
    public function index()
    {
        //1.查询id为41的数据 sql:SELECT * FROM `think_user` WHERE  `id` = 1 LIMIT 1
        // $result = Db::table("cxy_user")->where("id", 41)->find();//http://localhost/data/index 直接访问即可出数据
        /* $result = app("db")->table("cxy_user")->where("id", 41)->find();
         dump($result);*/
        //2 查询 find方法查询结果不存在，返回 null，否则返回结果数组,SELECT * FROM `cxy_user` WHERE `id` = 1 LIMIT 1,
        //如果不存在的时候，想要返回一个空数组的时候,可以使用
        /*$result = Db::table("cxy_user")->where("id", 1)->findOrEmpty();
        dump($result);*/
        //3 .如果希望在没有找到数据后抛出异常可以使用,
        /* $result = app("db")->table("cxy_user")->where("id", 2)->findOrFail();
         dump($result);*/
        //4.如果表不存在会报错，输入的表名不存在
        /*$result1 = app("db")->table("cxy_user1")->where("id", 41)->findOrFail();
        dump($result1);*/
        //5.查询数据集:查询多个数据使用select方法
        /*$result = Db::table("cxy_user")->where("sex","男")->select();
        dump($result);*/
        /**
         * ^ think\Collection {#55 ▼
         * #items: array:3 [▼
         * 0 => array:5 [▼
         * "id" => 41
         * "username" => "老王"
         * "birthday" => "2018-02-27 17:47:08"
         * "sex" => "男"
         * "address" => "北京"
         * ]
         * 1 => array:5 [▶]
         * 2 => array:5 [▶]
         * ]
         * }
         */
        //6.如果希望在没有查找到数据后抛出异常,可以使用：
        /*$result = Db::table("cxy_user")->where("sex","女")->selectOrFail();
        dump($result);*/
        //7. 如果设置了数据表前缀参数的话，可以使用
        /*$result = Db::name("user")->where('id', 41)->find();
        dump($result);*/
        //8.查询某一列的值可以使用
        //返回数组
        /* $result = Db::table('cxy_user')->where('sex',"女")->column('sex');
         dump($result);*/
        //如果要返回一个完整的数据,并且添加一个索引值的话，可以使用
        /*$result = Db::table('cxy_user')->where("sex","男")->column('sex','id');
        dump($result);*/


        /***
         * 添加数据
         */
        //可以使用save方法统一写入数据
        //注意，我cxy_user表中，id为自增主键，当我$data = [‘id’=>'1','username'=>'111','sex'=>'男'];
        //当我设置id值插入的时候，就会插入不进去
        /*$data = ['username'=>'222','sex'=>'男'];
        Db::name("cxy_user")->save($data);*/

        /**
         * 表中username是必穿的，当我们不去传值
         */
        /*$data = ['sex'=>'男'];
        Db::name("cxy_user")->save($data);*/
        //运行：http://localhost/data/index 报错: Field 'username' doesn't have a default value

        //添加数据后如果需要返回新增数据的自增主键，可以使用insertGetId方法新增数据并返回主键值：
        /*$data = ['username'=>'9999','sex'=>'男'];
        Db::name("cxy_user")->save($data);*/

        /**
         * 如果不希望抛出异常，可以使用下面的方法：
         */
        /*  $data = ['sex'=>'男'];
          Db::name("cxy_user")->save($data);*/

        /**
         * 添加数据后如果需要返回新增数据的自增主键，可以使用insertGetId方法新增数据并返回主键值
         */
        /*$data = ['username' => '88888', 'sex' => '男'];
        $userId = Db::name('cxy_user')->insertGetId($data);
        dump($userId);*/

        /**
         * 添加多条数据
         * 添加多条数据直接向 Db 类的 insertAll 方法传入需要添加的数据（通常是二维数组）即可。
         */
        /*$data = [
            ['username' => '1', 'sex' => '男'],
            ['username' => '2', 'sex' => '男'],
            ['username' => '3', 'sex' => '1']
            //虽然sex设置的是1,但是也是能插入进去
        ];
        Db::name('cxy_user')->insertAll($data);*/

        /**
         * 如果是Mysql数据库，支持replace写入,
         */
        /* $data = [
             ['id' => "57", 'username' => '1', 'sex' => '1'],
         ];
         Db::name('cxy_user')->replace()->insertAll($data);*/

        /***
         * 更新数据 ,可以使用save或者使用update都是可以的
         * //注意，我的数据库里没有id=1的数据，这里并没有任何异常提示
         */
        /* Db::name('cxy_user')
             ->save(['id' => "57", 'username' => 'thinkphpPro']);*/
        //注意，上面的'id' => "57"，也不会出错，或者说'id' => '57'也不会出错

        /**
         * 或者使用update方法。
         * //因为我的数据库里没有58=id,也没有爆任何的异常
         */
        //Db::table("cxy_user")->where('id',58)->update(["username"=>"changxueyi"]);

        /**
         * 正常的修改,>where('id',"57"),因为是id，57可以加引号，也可以不加引号，但是update(["username"=>liyanru]);不加引号，就会出错
         */
        /* Db::table("cxy_user")->where('id', "57")->update(["username" => "liyanru"]);*/
        /*Db::name('cxy_user')
            ->where('id', 55)
            ->data(['username' => 'thinkphp'])
            ->update(); //要么,Db name where update[()] 要么 db name where data update()*/

        //如果update方法和data方法同时传入更新数据，则以update方法为准。


        //如果数据中包含主键，可以直接使用：
        /* Db::name('cxy_user')
             ->update(['username' => '百度','id' => 56]);*/

        // score 字段加 1
        /* Db::table('cxy_user')
             ->where('id', 55)
             ->inc('score')
             ->update();*/

        /**
         * 删除数据
         */
        // 根据主键删除
        //Db::table('cxy_user')->delete(51);
        //Db::table('think_user')->delete([1,2,3]);

        //根据条件进行删除
        //Db::table('cxy_user')->where('id', 52)->delete();
        //Db::table('cxy_user')->where('id','>',"55");

        /**
         * 一般情况下，业务数据不建议真实删除数据，系统提供了软删除机制（模型中使用软删除更为方便
         */
        // 软删除数据 使用delete_time字段标记删除
        /* Db::name('cxy_user')
             ->where('id', 57)
             ->useSoftDelete('birthday',time())
             ->delete();
         //seSoftDelete方法表示使用软删除，并且指定软删除字段为birthday，写入数据为当前的时间戳。*/


        /***
         * 查询表达式
         */
        //不等于
        //$result = Db::table("cxy_user")->where('id', '<>', 100)->selectOrFail();
        //dump($result);
        //小于等于
        /* $result = Db::name('cxy_user')->where('id', '<=', 100)->select();
         dump($result);*/

        //模糊查询
        /* $result = Db::name('cxy_user')->where("username", 'like', 'think%')->select();
         dump($result);*/

        //BETWEEN  区间查询,包括id=54 也包括id=57
        /*$result = Db::name('cxy_user')->where('id', 'between', '54,57')->select();
        dump($result);*/

        /**
         * 查询，in 同sql中的in
         */
        /*  $result = Db::name('cxy_user')->where('id', 'in', '1,5,8')->select();
          dump($result);*/
        //上面的因为没有id等于1，5，8，的，所以返回^ think\Collection {#56 ▼
        //  #items: []
        //}
        /*$result = Db::name('cxy_user')->where('id', 'in', [55, 56, 49])->select();
        dump($result);*/
        //上面的语句就会返回三条数据,因为数据库中包含了这三条的数据，
        //举例，加入100 ，数据库没有id=100的数据，所以
        /*$result = Db::name('cxy_user')->where('id', 'in', [55, 56, 100])->select();*/
        //就会返回两条的数据，分别是id=55，id=54的数据，

        //或者使用快捷查询方法：
        /* $result = Db::name("cxy_user")->whereIn("id", '55,56,100')->select();
         dump($result);//还是会输出两条的数据*/
        //同样也可以使用whereNotIn：Db::name('user')->whereNotIn('id','1,5,8')->select();


        //NULL
        //查询字段是否（不）是Null，例如：
        /* $result = Db::name("cxy_user")->where("birthday", "null")
             ->where("address", "null")
             ->select();
         dump($result);//共得到7条数据，数据的查询条件为birthday =  null && address = null 的数据*/

        /**
         * 链式操作
         */
        //需求：现在需要得到，user表中为女性的前两条数据,并且数据排序为，birthday的升序
        /*$result = Db::table("cxy_user")->where("sex", "女")
            ->order("birthday")
            ->limit(2)
            ->select();
        dump($result);*/
        //下面为返回的数据
        /***
         * ^ think\Collection {#55 ▼
         * #items: array:2 [▼
         * 0 => array:5 [▼
         * "id" => 42
         * "username" => "小二王"
         * "birthday" => "2018-03-02 15:09:37"
         * "sex" => "女"
         * "address" => "北京金燕龙"
         * ]
         * 1 => array:5 [▼
         * "id" => 43
         * "username" => "小二王"
         * "birthday" => "2018-03-04 11:34:34"
         * "sex" => "女"
         * "address" => "北京金燕龙"
         * ]
         * ]
         * }
         */
        //这里的where、order和limit方法就被称之为链式操作方法，除了select方法必须放到最后一个外（因为select方法并不是链式操作方法），
        //链式操作的方法调用顺序没有先后 ,下面的sql依然有效
        /* Db::table('think_user')
             ->order('create_time')
             ->limit(10)
             ->where('status',1)
             ->select();*/

        //其实不仅仅是查询方法可以使用连贯操作，包括所有的CURD方法都可以使用，例如：

        /*$result = Db::table("cxy_user")
            ->where("id", 56)
            ->field('id,username,address')
            ->find();
        dump($result);*/
        //上面的sql返回的数据为
        /**
         * ^ array:3 [▼
         * "id" => 56
         * "username" => "百度"
         * "address" => null
         * ]
         */

        /***
         * 聚合查询
         */
        //获取用户数：
        /* $result = Db::table("cxy_user")->count();
         dump($result);*/
        //访问http://localhost/data/index，返回数据13

        //或者根据字段统计：
        /* $result = Db::table('cxy_user')->count("id");
         dump($result);*/

        //获取时间的最大值
        /* $result = Db::table("cxy_user")->max("birthday");
         dump($result);//2018.0*/


        //如果你要获取的最大值不是一个数值，可以使用第二个参数关闭强制转换
        /*$result = Db::table('cxy_user')->max('username', false);
        dump($result);//^ "老王"*/
        //统计用户总成绩等（和自己的表数据无关）
        //Db::table('think_user')->where('id',10)->sum('score');

        /***
         * 分页实现
         */
        $result = Db::name("cxy_user")->where("sex", "男")->order('id', "desc")->paginate(3);
        dump($result);

    }

}
