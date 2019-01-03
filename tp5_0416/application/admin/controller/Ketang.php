<?php
namespace app\admin\controller;
use think\Controller;

class Ketang extends Basic {
	//显示全部信息
	public function lists(){
		$orderList = \think\Db::name('ketang')->order('djtime', 'desc')->paginate(15);
		if(request()->isAjax()){
			$ketangid = input('ketangid');
			$baomingList = \think\Db::name('baoming')->where('ketangid', $ketangid)->order('djtime', 'desc')->select();
			if($baomingList){
				return $baomingList;
			}else{
				return 'error';
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	// 新增
	public function add(){
		if(request()->isPost()){
			$djtime = date('Y-m-d H:i:s', time());
			$data = [
				'title' => input('title'),
				'djtime' => $djtime,
				'xgtime' => $djtime,
				'ketangtime' => input('ketangtime'),
				'over' => input('over'),
				'imgurl' => input('imgurl'),
				'detailimgurl' => input('detailimgurl'),
				'online' => input('online'),
				'free' => input('free'),
			];

			// 对输入的内容进行验证，使用tp5推荐的验证器的方式
			$validate = \think\Loader::validate('ketang');
			if($validate->check($data)){
				$res = \think\Db::name('ketang')->insert($data);
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

	public function edit(){
		$id = input('id');
		$orderList = db('ketang')->where('id', $id)->find();
		$this->assign('orderList', $orderList);
		if(request()->isPost()){
			$xgtime = date('Y-m-d H:i', time());
			$referrer = input('referrer');
			$data = [
				'title' => input('title'),
				'xgtime' => $xgtime,
				'ketangtime' => input('ketangtime'),
				'over' => input('over'),
				'imgurl' => input('imgurl'),
				'detailimgurl' => input('detailimgurl'),
				'online' => input('online'),
				'free' => input('free'),
			];
			$validate = \think\Loader::validate('ketang');
			$res = \think\Db::name('ketang')->where('id', $id)->update($data);
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