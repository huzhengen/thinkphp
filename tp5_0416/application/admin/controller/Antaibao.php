<?php
namespace app\admin\controller;
use think\Controller;

class Antaibao extends Basic {
	public function lists(){
//		$sql = "SELECT `dianhua`,COUNT(`dianhua`) AS c FROM `tp5_0416_antaibao` GROUP BY `dianhua` ORDER BY c DESC LIMIT 10";
		$tel = \think\Db::name('antaibao')->field('dianhua,count(dianhua)')->group('dianhua')->select();
		$this->assign('tel', $tel);
		$patientLists = \think\Db::name('antaibao')->order('id DESC')->paginate('15');
		$this->assign('patientLists', $patientLists);
		return $this->fetch();
	}

	public function edit(){
		$id = input('id');
		$shtime = date('Y-m-d H:i:s', time());
		$patientLists = db('antaibao')->find($id);
		$this->assign('patientLists', $patientLists);
		if(request()->isPost()){
			$data = [
				'id'=>input('id'),
				'shtime' => $shtime,
				'kefuid'=>input('kefuid'),
				'kefutype'=>input('kefutype'),
				'kefuname'=>input('kefuname'),
				'queren'=>input('queren'),
				'beizhu'=>input('beizhu'),
			];
			$res = \think\Db::name('antaibao')->update($data);
			if($res){
//				return $this->success('审核成功', 'lists');
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