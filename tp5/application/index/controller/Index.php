<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use \app\index\controller\User;
use \app\admin\controller\Index as AdminIndex;
use think\Config;

class Index extends Controller
{
	//index方法
    public function index()
    {
        // return '<h1>前台首页</h1>';

        $data = Db::table('user') -> select();
        // var_dump($data);

        $this -> assign('data', $data);

        return view();
    }

    // test方法
    public function test(){
    	return "<h1>test</h1>";
    }

    //读取配置文件
    public function getConfig(){
        //输出配置文件
        // dump(config());
        echo config('database.password');//读取database扩展配置
        echo "<hr>";
        //1
        echo config('paginate.type');
        echo "<hr>";
        //2
        echo \think\Config::get('paginate.type');
        echo "<hr>";
        //3
        echo Config::get('paginate.type');
        echo "<hr>";
    }

    //调用前台的User控制器
    public function callFront(){
    	
    	//1
    	//$model = new \app\index\controller\User;
    	//echo $model -> index();

    	//2
    	//$model = new User();
    	//echo $model -> index();

    	//3
    	$model = controller('User');
    	echo $model -> index();
    }

    //调用后台的控制器
    public function callEnd(){
    	//1
    	// $model = new \app\admin\controller\Index;
    	// echo $model -> index();

    	//2
    	//$model = new AdminIndex();
    	//echo $model -> index();

    	//3
    	$model = controller('admin/Index');
    	echo $model -> index();
    }

    //调用前台当前控制器中的方法
    public function callIndexFn(){
    	//1
    	//echo $this -> test();

    	//2
    	// echo self::test();

    	//3
    	// echo Index::test();

    	//4
    	echo action('test');
    }

    //调用前台其他控制器中的方法
    public function callUserFn(){
    	//1
    	$model = new \app\index\controller\User;
    	echo $model -> index();
    	echo "<hr>";

    	//2
    	echo action('User/index');
    	echo "<hr>";

    }

    //调用后台index控制器中的方法
    public function callAdminIndexFn(){
    	//1
    	$model = new \app\admin\controller\Index;
    	echo $model -> index();
    	echo "<hr>";

    	//2
    	echo action('admin/Index/index');
    	echo "<hr>";
    	
    }
}
