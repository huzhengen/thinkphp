<?php
namespace app\admin\controller;
use think\Controller;

class Order extends Basic {
	public function lists(){
		$orderList = \think\Db::name('order')->where('del', 0)->paginate('11');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}
	public function listsquery(){
		$orderList = \think\Db::name('order')->where('del', 0)->paginate('11');
		if(request()->isPost()){
			$queryname = input('name');
			$querybegintime = input('begintime');
			$queryendtime = input('endtime');
			if($queryname){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('name',$queryname)
					->paginate('11');
			}else if($querybegintime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime', '>', $querybegintime)
					->paginate('11');
			}else if($queryname && $querybegintime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('name',$queryname)
					->where('djtime', '>', $querybegintime)
					->paginate('11');
			}else{
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('name',$queryname)
					->where('djtime', 'between', [$querybegintime, $queryendtime])
					->paginate('11');
			}
//			dump($orderList);
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function listsdel(){
		$orderList = \think\Db::name('order')->where('del', 1)->paginate('11');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function listsmyself(){
		$kefuid = session('id');
		$orderList = \think\Db::name('order')->where('kefuid', $kefuid)->where('del', 0)->paginate('11');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function listsordertoday(){
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('yytime', 'between', [$datebegin, $dateend])->paginate('11');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function listsdztoday(){
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('dztime', 'between', [$datebegin, $dateend])->paginate('11');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function listsaddtoday(){
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('djtime', 'between', [$datebegin, $dateend])->paginate('11');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function add(){
		if(request()->isPost()){
			$data = [
				'name' => input('name'),
				'sex' => input('sex'),
				'age' => input('age'),
				'djtime' => input('djtime'),
				'xgtime' => input('xgtime'),
				'yytime' => input('yytime'),
				'dztime' => input('dztime'),
				'kefu' => input('kefu'),
				'kefuid' => input('kefuid'),
				'desc' => input('desc'),
				'qudao' => input('qudao'),
				'tel' => input('tel'),
				'beizhu' => input('beizhu'),
			];
			// 判断表单是否上传了文件
			if($_FILES['pic']['tmp_name']){
				//获取表单上传的文件
				$file = request()->file('pic');
				//移动到框架应用根目录/public/uploads/目录下
				$info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads');
				if($info){
					$data['pic'] = '/static/uploads' . '/' . date('Ymd') . '/' . $info->getFilename();
				}else{
					return $this->error($file->getError());
				}
			}
			// 对输入的内容进行验证，使用tp5推荐的验证器的方式
			$validate = \think\Loader::validate('order');
			if($validate->check($data)){
				$res = \think\Db::name('order')->insert($data);
				if($res){
					return $this->success('增加成功');
				}else{
					return $this->error('增加失败');
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
		$orderList = db('order')->where('id', $id)->find();
		$this->assign('orderList', $orderList);
		if(request()->isPost()){
			$data = [
				'name' => input('name'),
				'sex' => input('sex'),
				'age' => input('age'),
				'djtime' => input('djtime'),
				'xgtime' => input('xgtime'),
				'yytime' => input('yytime'),
				'dztime' => input('dztime'),
				'kefu' => input('kefu'),
				'kefuid' => input('kefuid'),
				'desc' => input('desc'),
				'qudao' => input('qudao'),
				'tel' => input('tel'),
				'beizhu' => input('beizhu'),
			];
			$validate = \think\Loader::validate('order');
			if($validate->check($data)){
				$res = \think\Db::name('order')->where('id', $id)->update($data);
				if($res){
					$this->success('修改成功', 'lists');
				}else{
					$this->error('修改失败');
				}
			}
		}
		return $this->fetch();
	}

	public function delfalse(){
		$id = input('id');
		$data = [
			'del' => 1,
		];
		if(db('order')->where('id', $id)->update($data)){
			return $this->success('删除信息到回收站成功', 'lists');
		}else{
			return $this->error('删除信息到回收站失败');
		}
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
		if(db('order')->delete($id)){
			return $this->success('彻底删除信息成功', 'lists');
		}else{
			return $this->error('彻底删除信息失败');
		}
		return $this->fetch();
	}
}