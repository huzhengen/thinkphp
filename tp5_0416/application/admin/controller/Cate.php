<?php
namespace app\admin\controller;
use think\Controller;

class Cate extends Controller{
	public function lists(){
		return $this->fetch();
	}

	public function add(){
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

}
