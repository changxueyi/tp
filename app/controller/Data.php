<?php

namespace app\Controller;

use app\BaseController;

use app\model\Cxy_User;
use app\model\Demo;
use app\model\User;
use app\Request;
use http\Message\Body;
use think\db\Where;
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
        /* $result = Db::name("cxy_user")->where("sex", "男")->order('id', "desc")->paginate(3);
         dump($result);*/

        /**
         * 时间查询
         * whereTime方法提供了日期和时间字段的快捷查询，示例如下：
         */
        /*$result = Db::name("cxy_user")
            ->whereTime("birthday", '>=', '1970-10-1')
            -select();
        dump($result);*/

        /**
         * 查询两个小时内的博客
         */
        /*$result = Db::name("blog")
            ->whereTime("create_time", '-2 hours');
        //查询某个时间的区间
        Db::table('cxy_user')->whereBetweenTime("create_time", '2017-01-01', '2017-06-30')
            ->select();

        //查询不是2017年上半年注册的用户
        Db::name("cxy_user")
            ->whereNotBetweenTime("create_time", '2017-01-01', '2017-06-30')
            ->select();

        //查询某年
        Db::name("cxy_user")
            ->whereYear("create_time")
            ->select();

        //查询某月
        Db::name("cxy_user")
            ->whereMonth("create_time")
            ->select();

        //查询某周
        Db::name("cxy_user")
            ->whereWeek("create_time")
            ->select();

        //查询某天，查询某天注册的用户
        Db::name("cxy_user")
            ->whereDay("create_time")
            ->select();*/

        /***
         * 分页,Page函数 page(第几页，一页多少数据）
         */
        /*  $result = Db::table('cxy_user')
              ->order('id', "desc")
              ->page(2, 2)
              ->select();
          dump($result);*/

    }

    /**
     * 数据库排查方案 ,SQL SQL调试核心的方式方法
     */

    public function abc()
    {
        //第一种，输入SQL方式就是使用控制器的SQL 进行查看

        //第二种查看数据未返回的方式方法
        $result = Db::table("cxy_user")
            ->where("id", 10)
            ->find();
        echo Db::getLastSql();
        exit;
        http://127.0.0.1/data/index
        dump($result);
    }

    /**
     * Db操作数据库的增加，修改，删除
     */
    public function demo()
    {
        $data = ["username" => "changxueyilalal", "sex" => "男"];
        $result = Db::name("cxy_user")
            ->insert($data);
        echo Db::getLastSql();
        dump($result);
    }
    /**
     * 一般场景都是假删除，后来通过一个脚本去扫库，然后去处理，实际开发项目中是这样的
     */

    /**
     * 通过模型去操作数据库
     */
    //调用Model ,http://127.0.0.1/data/model1
    public function model1()
    {
        $result = User::find(45);
        dump($result->toArray());//把对象转为数组
    }

    /***
     *通过模型操作查询其他使用
     */

    public function model2()
    {
        $modelObj = new User();
        $results = $modelObj
            ->where("id", "49")
            /*            ->limit(2)
                        ->order("id", "desc")*/
            ->select();

        foreach ($results as $result) {
            dump($result['content']);
        }
    }

    /**
     * 使用模型进行处理数据
     */
    public function model3()
    {
        //获取数据
        //$user = User::find(41);
        //echo $user->address;
        //echo $user->username;
        //echo $user->address."".$user->username;字符串输出
        //http://127.0.0.1/data/model3 ,输出北京老王


        //由于模型类实现了ArrayAccess接口，所以可以当成数组使用。
        /* $user = User::find(42);
         echo $user["username"]."".$user["birthday"]."".$user["address"];
         //访问http://127.0.0.1/data/model3  输出小二王2018-03-02 15:09:37北京金燕龙*/


        //模型赋值
        /*$user = new User();
        $user->username = "百度科技";
        $user->address = "中关村";*/

        //该方式赋值会自动执行模型的修改器，如果不希望执行修改器操作，可以使用
        /*$data['username']='changxueyi';
        $data['address']=100;
        $user = new User($data);*/

        //此处样额区分大小写
        //如果不想区分大小写,可以使用


        //添加一条数据
        //第一种是实例化模型对象后赋值并保存：
        /*      $user = new User;
              $user->name ="changxuyi";
              $user->email = "changxueyi@jd.com";
              $user->save();*/

        //也可以直接传入数据到save方法批量赋值：
        //默认只会写入数据表已有的字段，如果你通过外部提交赋值给模型，并且希望指定某些字段写入，可以使用：
        /*$user = new User;
        //post数组中只有name 和email字段会写入
        $user->allowField(['name','email'])->save($_POST);*/

        //最佳的建议是模型数据赋值之前就进行数据过滤，例如：
        /*    $user = new User;
            //过滤POST 数组中的非数据表字段数据
            $data = Request::only(['name','email']);*/
        //$user->save($data);
        //save方法返回的是写入的记录数

        //replace()写入
        //save 方法可以支持replace写入
        /* $user = new User;
         $user->username = "jisuanjikexueyujishu";
         $user->address = "北京大兴区科创十一街";
         $user->replace()->save();*/


        //获取自增ID
        //如果想要获取到新增的数据自增id，可以使用下面的方式
        /*$user = new User;
        $user->name = "changxueyi";
        $user->save();
        //获取自增ID
        echo $user->id;*/

        //不要在同一个实例里面多次新增数据，如果确实需要多次新增，可以使用后面的静态方法处理。

        //批量增加数据
        /*$user = new User;
        $list = [
            ["username"=>"1111",'address'=>"2222"],
            ["username"=>"2222",'address'=>"33333"]
        ];
        $user->saveAll($list);*/
        //saveAll方法新增数据返回的是包含新增模型（带自增ID）的数据集对象。


        //静态方法
        /* $user = User::create([
             "username"=>"chang",
             "address"=>"北京京东数字科技"
         ]);
         echo $user->username.''.$user->address.''.$user->id;*/
        //http://127.0.0.1/data/model3 返回chang北京京东数字科技102
        //和save方法不同的是，create方法返回的是当前模型的对象实例。
    }

    /**
     * 利用模型进行更新的操作
     *
     */
    public function model4()
    {
        /*//查找并更新
        $user = User::find(102);
        dump($user);
        $user->username = "changxueyi";
        $user->address = "洛阳市11";
        $user->save();
        //save方法成功返回true，并只有当before_update事件返回false的时候返回false，有错误则会抛出异常。*/


        //对于复杂的查询条件，也可以使用查询构造器来查询数据并更新
        $user = User::where('sex', "男")
            ->where("username", "常学奕")
            ->find();
        $user->username = "李艳茹";
        $user->sex = '女';
        $user->address = "iliyanru@163.com";
        $user->save();
        //save方法更新数据，只会更新变化的数据，对于没有变化的数据是不会进行重新更新的。如果你需要强制更新数据，可以使用下面的方法：
        echo Db::getLastSql();
    }

    /**
     * 删除操作
     *
     */
    public function model5()
    {
        // 删除当前模型
        ////除模型数据，可以在查询后调用delete方法。
     /*   $user = User::find(54);
        $user = delete();*/
        //delete方法返回布尔值

        //根据主键查询
        User::destroy(54);
    }

}
