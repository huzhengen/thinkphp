<?php
namespace app\admin\controller;
use think\Controller;

class Admin extends Basic{
	public function lists(){
		$adminres = \think\Db::name('admin')->paginate(3);
		$this->assign('adminres', $adminres);
		return $this->fetch();
	}
	public function add(){
		if(request()->isPost()){
			$data = [
				'username'=>input('username'),
				'password'=>input('password'),
			];
			$validate = \think\Loader::validate('Admin');
			if($validate->check($data)){
				$data['password'] = md5($data['password']);
				$res = \think\Db::name('admin')->insert($data);
				if($res){
					return $this->success('管理员添加成功', 'lists');
				}else{
					return $this->error('管理员添加失败');
				}
			}else{
				return $this->error($validate->getError());
			}
			return;
		}
		return $this->fetch();
	}
	public function edit(){
		$id = input('id');
		$admins = db('admin')->find($id);
		$this->assign('admins', $admins);
		if(request()->isPost()){
			$data = [
				'id'=>input('id'),
				'username'=>input('username'),
				'password'=>input('password'),
			];
			$validate = \think\Loader::validate('Admin');
			if($validate->check($data)){
				$data['password'] = md5($data['password']);
				$res = \think\Db::name('admin')->update($data);
//				var_dump($res);
				if($res){
					return $this->success('修改管理员成功', 'lists');
				}else{
					return $this->error('修改管理员失败');
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
				return $this->success('删除管理员成功');
			}else{
				return $this->error('删除管理员失败');
			}
		}
		return $this->fetch();
	}
}