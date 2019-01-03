<?php
namespace app\admin\controller;
use think\Controller;

class Baoming extends Basic {
	//显示全部信息
	public function lists(){
		$orderList = \think\Db::name('baoming')->order('id', 'desc')->paginate(15);
		$ketang = \think\Db::name('ketang')->order('id', 'desc')->select();
		$this->assign([
			'orderList'=> $orderList,
			'ketang'=> $ketang,
		]);
		return $this->fetch();
	}

	// 后台新增
	public function add(){
		$ketangid = \think\Db::name('ketang')->order('id', 'desc')->select();
		$this->assign('ketangid', $ketangid);
		$avatar = 'https://mini.atfck.com/yxkt/defaultavatar.png';
		if(request()->isPost()){
			$djtime = date('Y-m-d H:i:s', time());
			$data = [
				'name' => input('name'),
				'djtime' => $djtime,
				'ketangid' => input('ketangid'),
				'tel' => input('tel'),
				'beizhu' => input('beizhu'),
				'type' => input('type'),
				'avatar' => $avatar,
			];

			// 对输入的内容进行验证，使用tp5推荐的验证器的方式
			$validate = \think\Loader::validate('baoming');
			if($validate->check($data)){
				$res = \think\Db::name('baoming')->insert($data);
				if($res){
					return $this->success('增加成功');
				}else{
					return $this->error('增加失败');
				}
			}else{
				return $this->error($validate->getError());
			}
		}
		return $this->fetch();
	}

	// 小程序报名新增
	public function addxcx(){
		if(request()->isAjax()){
			$djtime = date('Y-m-d H:i:s', time());
			$data = [
				'name' => input('name'),
				'djtime' => $djtime,
				'ketangid' => input('ketangid'),
				'tel' => input('tel'),
				'type' => input('type'),
			];

			// 对输入的内容进行验证，使用tp5推荐的验证器的方式
			$validate = \think\Loader::validate('baoming');
			if($validate->check($data)){
				$res = \think\Db::name('baoming')->insert($data);
				if($res){
					return '报名成功';
				}else{
					return '报名失败';
				}
			}else{
				return '报名失败';
			}
		}
	}

	public function edit(){
		$id = input('id');
		$orderList = db('baoming')->where('id', $id)->find();
		$ketang = \think\Db::name('ketang')->order('id', 'desc')->select();
		$this->assign([
			'ketang' => $ketang,
			'orderList' => $orderList,
		]);
		if(request()->isPost()){
			$referrer = input('referrer');
			$data = [
				'name' => input('name'),
				'ketangid' => input('ketangid'),
				'tel' => input('tel'),
				'beizhu' => input('beizhu'),
			];
			$validate = \think\Loader::validate('baoming');
			$res = \think\Db::name('baoming')->where('id', $id)->update($data);
			if($res){
//				$this->success('修改成功', 'lists');
				echo "<script>alert('修改成功');window.location.href='$referrer'</script>";
			}else{
				$this->error('修改失败');
			}
		}
		return $this->fetch();
	}


}