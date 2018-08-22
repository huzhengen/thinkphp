<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Login as Log;
use think\Request;
use think\Cookie;

class Login extends Controller{
	public function login(){
		if(session('id')){
			return $this->success('已登录', 'order/lists');
		}
		if(request()->isPost()){
			$login = new Log;
			$status = $login->login(input('username'), input('password'));
			if($status === 1){
				$id = session('id');
				$logintime = date('Y-m-d H:i:s', time());
				$loginip = Request::instance()->ip();
				$data = [
					'logintime' => $logintime,
					'loginip' => $loginip,
				];
				\think\Db::name('admin')->where('id', $id)->update($data);
				return $this->success('登陆成功，正在跳转', 'order/lists');
			}else if($status === 4){
				return $this->error('该用户已被锁定，无法登录');
			}else if($status === 2){
				return $this->error('帐号或者密码错误');
			}else if($status ===5 ){
				return $this->error('验证码错误');
			}else{
				return $this->error('用户不存在');
			}
		}
		return $this->fetch('login');
	}
	public function logout(){
		$id = session('id');
		$data0 = [
			'online' => '0'
		];
//		$res0 = \think\Db::name('admin')->where('id','<>','0')->update($data0);
		$res0 = \think\Db::name('admin')->where('id', $id)->update($data0);
		session(null);
		Cookie::delete('id');
		return $this->success('退出成功', url('login'));
	}

	public function captcha(){
		if(request()->isAjax()){
			$captcha = input('captcha');
			if(!captcha_check($captcha)){
				return 5;
			}else{
				return 6;
			}
		}
	}

	public function password(){
		if(request()->isAjax()){
			$username = input('username');
			$password = input('password');
			$equalList = \think\Db::name('admin')->where('username', $username)->field('password')->find();
//			dump($equalList['password']);
//			dump(md5($password));
			if($equalList['password'] === md5($password)){
				return 1;
			}else{
				return 0;
			}
		}
	}
}