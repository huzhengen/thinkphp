<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Login as Log;
use think\Request;

class Login extends Controller{
	public function login(){
		if(session('id')){
			return $this->success('已登录', 'index/index');
		}
		if(request()->isPost()){

			/**
			 * 输出二次验证结果,本文件示例只是简单的输出 Yes or No
			 */
			// error_reporting(0);
//			require_once dirname(dirname(__FILE__)) . '/lib/class.geetestlib.php';
//			require_once dirname(dirname(__FILE__)) . '/config/config.php';
			require_once '/gt3-php-sdk/lib/class.geetestlib.php';
			require_once '/gt3-php-sdk/config/config.php';
//			session_start();
			$GtSdk = new \GeetestLib(CAPTCHA_ID, PRIVATE_KEY);

			$data = array(
				"user_id" => $_SESSION['user_id'], # 网站用户id
				"client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
				"ip_address" => "127.0.0.1" # 请在此处传输用户请求验证时所携带的IP
			);

			if ($_SESSION['gtserver'] == 1) {   //服务器正常
				$result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
				if ($result) {
//					echo '{"status":"success"}';
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
						return $this->success('登陆成功，正在跳转', 'index/index');
					}else if($status === 4){
						return $this->error('该用户已被锁定，无法登录');
					}else if($status === 2){
						return $this->error('帐号或者密码错误');
					}else{
						return $this->error('用户不存在');
					}
				} else{
					echo "<script>alert('输入验证码')</script>";
				}
			}else{  //服务器宕机,走failback模式
				if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
//					echo '{"status":"success"}';
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
						return $this->success('登陆成功，正在跳转', 'index/index');
					}else if($status === 4){
						return $this->error('该用户已被锁定，无法登录');
					}else if($status === 2){
						return $this->error('帐号或者密码错误');
					}else{
						return $this->error('用户不存在');
					}
				}else{
					echo '{"status":"fail"}';
				}
			}

		}
		return $this->fetch('login');
	}
	public function logout(){
		session(null);
		return $this->success('退出成功', url('login'));
	}
}