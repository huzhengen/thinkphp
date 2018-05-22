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
		$patientLists = db('atfckform')->find($id);
		$this->assign('patientLists', $patientLists);
		if(request()->isPost()){
			$data = [
				'id'=>input('id'),
				'queren'=>input('queren'),
				'kefuid'=>input('kefuid'),
				'kefutype'=>input('kefutype'),
				'kefuname'=>input('kefuname'),
				'beizhu'=>input('beizhu'),
			];
			$res = \think\Db::name('atfckform')->update($data);
			if($res){
				return $this->success('修改成功', 'lists');
			}else{
				return $this->error('修改失败');
			}
		}
		return $this->fetch();
	}

	public function del(){
		return $this->fetch();
	}

	public function add(){
		$data = [
			'name'=>input('name'),
			'dianhua'=>input('tel'),
			'shijian'=>input('time'),
			'miaoshu'=>input('desc'),
			'queren'=>input('queren'),
		];

		$res = \think\Db::name('atfckform')->insert($data);
		if($res){
			echo "<script>alert('提交成功！'); history.go(-1)</script>";
		}else{
			echo "<script>alert('提交失败，请重新提交！'); history.go(-1)</script>";
		}
	}



}