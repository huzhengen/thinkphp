<?php
namespace app\admin\controller;
use think\Controller;

class Admin extends Basic{
	public function lists(){
		if(session('type') != 1){
			echo "<script>alert('需要管理员权限');history.go(-1)</script>";
		}else{
			$adminres = \think\Db::name('admin')->where('lock', '0')->order('id','asc')->paginate(11);
			$this->assign('adminres', $adminres);
			return $this->fetch();
		}
	}

	public function listslock(){
		if(session('type') != 1){
			echo "<script>alert('木有权限');history.go(-1)</script>";
		}else {
			$adminres = \think\Db::name('admin')->where('lock', '1')->paginate(11);
			$this->assign('adminres', $adminres);
			return $this->fetch();
		}
	}

	public function add(){
		if(request()->isPost()){
			$password = input('password');
			$repassword = input('repassword');
			$data = [
				'username'=>input('username'),
				'name'=>input('name'),
				'type'=>input('type'),
				'password'=>input('password'),
			];
			$validate = \think\Loader::validate('Admin');
			if($validate->check($data) && ($password === $repassword)){
				$data['password'] = md5($data['password']);
				$res = \think\Db::name('admin')->insert($data);
				if($res){
					return $this->success('添加用户成功', 'lists');
				}else{
					return $this->error('添加用户失败');
				}
			}else{
				return $this->error('验证失败了/两次密码不一样');
				return $this->error($validate->getError());
			}
			return;
		}
		if(session('type') != 1){
			echo "<script>alert('木有权限');history.go(-1)</script>";
		}else {
			return $this->fetch();
		}
	}
	public function edit(){
		if(session('type') != 1){
			$id = input('id');
			if($id != session('id')){
				echo "<script>alert('只能修改自己的信息');history.go(-1)</script>";
				$admins = db('admin')->find($id);
				$this->assign('admins', $admins);
			}else{
				$admins = db('admin')->find($id);
				$this->assign('admins', $admins);
				if (request()->isPost()) {
					$password = input('password');
					$repassword = input('repassword');
					$data = [
						'id' => input('id'),
						'username' => input('username'),
						'name' => input('name'),
						'type' => input('type'),
						'password' => input('password'),
					];
					$validate = \think\Loader::validate('Admin');
					if ($validate->check($data) && ($password === $repassword)) {
						$data['password'] = md5($data['password']);
						$res = \think\Db::name('admin')->update($data);
//				var_dump($res);
						if ($res) {
							return $this->success('修改用户成功', 'lists');
						} else {
							return $this->error('修改用户失败');
						}
					}else{
						return $this->error('验证失败了/两次密码不一样');
						return $this->error($validate->getError());
					}
				}
			}
		}else {
			$id = input('id');
			$admins = db('admin')->find($id);
			$this->assign('admins', $admins);
			if (request()->isPost()) {
				$password = input('password');
				$repassword = input('repassword');
				$data = [
					'id' => input('id'),
					'username' => input('username'),
					'name' => input('name'),
					'type' => input('type'),
					'password' => input('password'),
				];
				$validate = \think\Loader::validate('Admin');
				if ($validate->check($data) && ($password === $repassword)) {
					$data['password'] = md5($data['password']);
					$res = \think\Db::name('admin')->update($data);
//				var_dump($res);
					if ($res) {
						return $this->success('修改用户成功', 'lists');
					} else {
						return $this->error('修改用户失败');
					}
				}else{
					return $this->error('验证失败了/两次密码不一样');
					return $this->error($validate->getError());
				}
			}
		}
		return $this->fetch();
	}
	public function del(){
		$id = input('id');
		if($id==1){
			return $this->error('初始管理员不能删除！');
		}else{
			if(db('admin')->delete($id)){
				return $this->success('删除用户成功');
			}else{
				return $this->error('删除用户失败');
			}
		}
		return $this->fetch();
	}

	public function lock(){
		$id = input('id');
		$data = [
			'lock' => 1,
		];
		if(db('admin')->where('id', $id)->update($data)){
			return $this->success('锁定用户成功');
		}else{
			return $this->error('锁定用户失败');
		}
	}

	public function unlock(){
		$id = input('id');
		$data = [
			'lock' => 0,
		];
		if(db('admin')->where('id', $id)->update($data)){
			return $this->success('解锁用户成功');
		}else{
			return $this->error('解锁用户失败');
		}
	}
}