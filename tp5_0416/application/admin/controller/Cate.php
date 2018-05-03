<?php
namespace app\admin\controller;
use think\Controller;

class Cate extends Basic{
	public function lists(){
		$cateres = \think\Db::name('cate')->select();
		$this->assign('cateres', $cateres);
		return $this->fetch();
	}

	public function add(){
		//request方法继承于Controller，使用request助手函数判断请求方式
		//使用助手函数input接收输入的值
		if(request()->isPost()){
			$data = [
				'catename'=>input('catename'),
				'keyword'=>input('keyword'),
				'desc'=>input('desc'),
				'type'=>input('type') ? input('type') : 0,
			];
			$validate = \think\Loader::validate('Cate');
			if($validate->check($data)){
				$res = \think\Db::name('cate')->insert($data);
				if($res){
					return $this->success('添加栏目成功', 'lists');
				}else{
					return $this->error('添加栏目失败');
				}
			}else{
				return $this->error($validate->getError());
			}
			return;
		}
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
		if(db('cate')->delete($id)){
			return $this->success('删除栏目成功', 'lists');
		}else{
			return $this->error('删除栏目失败');
		}
	}

	public function edit(){
		// 获取修改的信息
		$id = input('id');
		$cates = db('cate')->where('ID', $id)->find();
		$this->assign('cates', $cates);
		// 修改后提交
		if(request()->isPost()){
			$data = [
				'ID'=>input('id'),
				'catename'=>input('catename'),
				'keyword'=>input('keyword'),
				'desc'=>input('desc'),
				'type'=>input('type') ? input('type') : 0,
			];
			//验证
			$validate = \think\Loader::validate('Cate');
			if($validate->scene('edit')->check($data)){
				$res = 	\think\Db::name('cate')->update($data);
				if($res){
					return $this->success('修改栏目成功', 'lists');
				}else{
					return $this->error('修改栏目失败');
				}
			}else{
				return $this->error($validate->getError());
			}
		}
		return $this->fetch();
	}



}
