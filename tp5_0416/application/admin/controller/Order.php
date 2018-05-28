<?php
namespace app\admin\controller;
use think\Controller;

class Order extends Basic {
	public function lists(){
		$orderList = \think\Db::name('order')->where('del', 0)->order('id', 'desc')->paginate('15');
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d H:i:s', time());
			if($daozhen == 1){
				$data = [
					'daozhen' => input('daozhen'),
					'dztime' => $dztime,
				];
				$res = \think\Db::name('order')->where('id', $id)->update($data);
				if($res){
					$ajaxdztime = \think\Db::name('order')->where('del', 0)->where('id', $id)->select();
					return $ajaxdztime;
				}
			}else{
				return '没有变化';
			}
		}
		if(request()->isPost()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$etime = input('endtime');
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('id');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');

			if($btime && !$etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','>', $begintime)
					->order('id', 'desc')->paginate('15');
			}
			if(!$btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','<', $endtime)
					->order('id', 'desc')->paginate('15');
			}
			if($btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','>', $begintime)
					->where('djtime','<', $endtime)
					->order('id', 'desc')->paginate('15');
			}
			if($kefu){
				$kefu = '%' . $kefu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('kefu', 'like', $kefu)
					->order('id', 'desc')->paginate('15');
			}
			if($id){
				$id = '%' . $id . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('id', 'like', $id)
					->order('id', 'desc')->paginate('15');
			}
			if($disease){
				$disease = '%' . $disease . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('disease', 'like', $disease)
					->order('id', 'desc')->paginate('15');
			}
			if($name){
				$name = '%' . $name . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('name', 'like', $name)
					->order('id', 'desc')->paginate('15');
			}
			if($beizhu){
				$beizhu = '%' . $beizhu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('beizhu',  'like', $beizhu)
					->order('id', 'desc')->paginate('15');
			}
			if($tel){
				$tel = '%' . $tel . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('tel', 'like', $tel)
					->order('id', 'desc')->paginate('15');
			}
			if($weixin){
				$weixin = '%' . $weixin . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('weixin', 'like', $weixin)
					->order('id', 'desc')->paginate('15');
			}
			if($qq){
				$qq = '%' . $qq . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('qq', 'like', $qq)
					->order('id', 'desc')->paginate('15');
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//回收站
	public function listsdel(){
		$orderList = \think\Db::name('order')->where('del', 1)->order('id', 'desc')->paginate('15');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//自己信息
	public function listsmyself(){
		$kefuid = session('id');
		$orderList = \think\Db::name('order')->where('kefuid', $kefuid)->where('del', 0)->order('id', 'desc')->paginate('15');
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//今日登记
	public function listsaddtoday(){
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('del', 0)->where('djtime', 'between', [$datebegin, $dateend])->order('id', 'desc')->paginate('15');
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d H:i:s', time());
			if($daozhen == 1){
				$data = [
					'daozhen' => input('daozhen'),
					'dztime' => $dztime,
				];
				$res = \think\Db::name('order')->where('id', $id)->update($data);
				if($res){
					$ajaxdztime = \think\Db::name('order')->where('del', 0)->where('id', $id)->select();
					return $ajaxdztime;
				}
			}else{
				return '没有变化';
			}
		}
		if(request()->isPost()){
			$time = input('time');
			$timebegin = $time . ' 00:00:00';
			$timeend = $time . ' 23:59:59';
			if($time){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','between', [$timebegin, $timeend])
					->order('id', 'desc')->paginate('15');
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//今日预约
	public function listsordertoday(){
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('del', 0)->where('yytime', 'between', [$datebegin, $dateend])->order('id', 'desc')->paginate('15');
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d H:i:s', time());
			if($daozhen == 1){
				$data = [
					'daozhen' => input('daozhen'),
					'dztime' => $dztime,
				];
				$res = \think\Db::name('order')->where('id', $id)->update($data);
				if($res){
					$ajaxdztime = \think\Db::name('order')->where('del', 0)->where('id', $id)->select();
					return $ajaxdztime;
				}
			}else{
				return '没有变化';
			}
		}
		if(request()->isPost()){
			$time = input('time');
			$timebegin = $time . ' 00:00:00';
			$timeend = $time . ' 23:59:59';
			if($time){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yytime','between', [$timebegin, $timeend])
					->order('id', 'desc')->paginate('15');
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//今日到诊
	public function listsdztoday(){
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('del', 0)->where('dztime', 'between', [$datebegin, $dateend])->order('id', 'desc')->paginate('15');
		if(request()->isPost()){
			$time = input('time');
			$timebegin = $time . ' 00:00:00';
			$timeend = $time . ' 23:59:59';
			if($time){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('dztime','between', [$timebegin, $timeend])
					->order('id', 'desc')->paginate('15');
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function tel(){
		if(request()->isAjax()){
			$tel = input('tel');
			$orderList = \think\Db::name('order')->where('del', 0)->where('tel', $tel)->find();
			return $orderList;
		}
	}

	public function add(){
		$djtime = date('Y-m-d H:i:s', time());
		$yytime = input('yytime');
		$dztime = input('dztime');
		if($yytime){
			$yuyue = 1;
		}else{
			$yuyue = 0;
		}
		if($dztime){
			$daozhen = 1;
		}else{
			$daozhen = 0;
		}
		if(request()->isPost()){
			$data = [
				'name' => input('name'),
				'sex' => input('sex'),
				'age' => input('age'),
//				'djtime' => input('djtime'),
				'djtime' => $djtime,
				'xgtime' => $djtime,
				'yytime' => input('yytime'),
				'dztime' => input('dztime'),
				'kefu' => input('kefu'),
				'kefuid' => input('kefuid'),
				'desc' => input('desc'),
				'qudao' => input('qudao'),
				'beizhu' => input('beizhu'),
				'yuyue' => $yuyue,
				'daozhen' => $daozhen,
				'czfz' => input('czfz'),
				'tel' => input('tel'),
				'del' => input('del'),
				'keshi' => input('keshi'),
				'doctor' => input('doctor'),
				'weixin' => input('weixin'),
				'qq' => input('qq'),
				'address' => input('address'),
				'jiehun' => input('jiehun'),
				'liaotian' => input('liaotian'),
				'yuanqu' => input('yuanqu'),
				'type' => input('type'),
				'disease' => input('disease'),
			];
			// 判断表单是否上传了文件
//			if($_FILES['pic']['tmp_name']){
//				//获取表单上传的文件
//				$file = request()->file('pic');
//				//移动到框架应用根目录/public/uploads/目录下
//				$info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads');
//				if($info){
//					$data['pic'] = '/static/uploads' . '/' . date('Ymd') . '/' . $info->getFilename();
//				}else{
//					return $this->error($file->getError());
//				}
//			}
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
			$xgtime = date('Y-m-d H:i:s', time());
			$yytime = input('yytime');
			$dztime = input('dztime');
			if($yytime){
				$yuyue = 1;
			}else{
				$yuyue = 0;
			}
			if($dztime){
				$daozhen = 1;
			}else{
				$daozhen = 0;
			}
			$data = [
				'sex' => input('sex'),
				'age' => input('age'),
				'xgtime' => $xgtime,
				'yytime' => input('yytime'),
				'dztime' => input('dztime'),
				'desc' => input('desc'),
				'qudao' => input('qudao'),
				'beizhu' => input('beizhu'),
				'yuyue' => $yuyue,
				'daozhen' => $daozhen,
				'czfz' => input('czfz'),
				'keshi' => input('keshi'),
				'doctor' => input('doctor'),
				'weixin' => input('weixin'),
				'qq' => input('qq'),
				'address' => input('address'),
				'jiehun' => input('jiehun'),
				'liaotian' => input('liaotian'),
				'yuanqu' => input('yuanqu'),
				'type' => input('type'),
			];
			$validate = \think\Loader::validate('order');
			$res = \think\Db::name('order')->where('id', $id)->update($data);
			if($res){
//				$this->success('修改成功', 'lists');
				echo "<script>alert('修改成功');history.go(-2)</script>";
			}else{
				$this->error('修改失败');
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

	public function recover(){
		$id = input('id');
		$data = [
			'del' => 0,
		];
		if(db('order')->where('id', $id)->update($data)){
			return $this->success('恢复成功', 'listsdel');
		}else{
			return $this->error('恢复失败');
		}
		return $this->fetch();
	}

	public function preview(){
		$id = input('id');
		$orderList = db('order')->where('id', $id)->find();
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}
}