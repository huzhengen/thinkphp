<?php
namespace app\admin\controller;
use think\Controller;

class Patient extends Basic {
	public function lists(){
		$tel = \think\Db::name('atfckform')->field('dianhua,count(dianhua)')->group('dianhua')->select();
		$this->assign('tel', $tel);
		$patientLists = \think\Db::name('atfckform')->order('id DESC')->paginate();
		$this->assign('patientLists', $patientLists);
		return $this->fetch();
	}

	public function listsAjax(){
		$patientLists = \think\Db::name('atfckform')->order('id DESC')->paginate();
		$this->assign('patientLists', $patientLists);
		return $patientLists;
	}

	public function edit(){
		$id = input('id');
		$shtime = date('Y-m-d H:i:s', time());
		$patientLists = db('atfckform')->find($id);
		$this->assign('patientLists', $patientLists);
		if(request()->isPost()){
			$data = [
				'id'=>input('id'),
				'shtime' => $shtime,
				'queren'=>input('queren'),
				'kefuid'=>input('kefuid'),
				'kefutype'=>input('kefutype'),
				'kefuname'=>input('kefuname'),
				'beizhu'=>input('beizhu'),
			];
			$res = \think\Db::name('atfckform')->update($data);
			if($res){
//				return $this->success('修改成功', 'lists');
//				return $this->success('修改成功');
				echo "<script>alert('审核成功');history.go(-2)</script>";
			}else{
				return $this->error('审核失败');
			}
		}
		return $this->fetch();
	}

	public function del(){
		return $this->fetch();
	}

}