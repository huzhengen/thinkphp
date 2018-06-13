<?php
namespace app\admin\model;
use think\Model;

class Login extends Model{
	//登陆数据处理函数
	//获取控制器传过来的登录名和密码，根据登录名在数据库中获取密码
	//若密码一样则给控制器返回1，若密码存在但是不一样放回2，或密码不存在返回3
	public function login($username, $password){
		$admin = \think\Db::name('admin')->where('username' , '=', $username)->find();
		if($admin){
			$captcha = input('captcha');
			if(!captcha_check($captcha)){
				return 5;
			}else {
				if($admin['lock'] == 1){
					return 4;
				}else{
					if($admin['password'] === md5($password)){
						//将登陆id和名词存入sesion
						\think\Session::set('id', $admin['id']);
						\think\Session::set('username', $admin['username']);
						\think\Session::set('name', $admin['name']);
						\think\Session::set('type', $admin['type']);
						\think\Session::set('logintime', $admin['logintime']);
						\think\Session::set('loginip', $admin['loginip']);
						return 1;
					}else{
						return 2;
					}
				}
			}
		}else {
			return 3;
		}
	}
}