<?php
namespace app\admin\controller;
use think\Controller;

class Patient extends Basic {
	public function lists(){
		$sessionname = session('name');
		$sessiontype = session('type');
		$online = \think\Db::name('admin')->where('online', '1')->field('name')->select();
		$this->assign('online', $online);
		if($sessiontype != 1 && $sessiontype != 3){
			if($online){
				$onlinename = $online[0]['name'];
				if($sessionname != $onlinename){
					echo "<script>alert('请点击左侧栏目进入');history.go(-1)</script>";
				}else{
					$data0 = [
						'online' => '0'
					];
					$data1 = [
						'online' => '1'
					];
					$res0 = \think\Db::name('admin')->where('name','<>', $sessionname)->update($data0);
					$res1 = \think\Db::name('admin')->where('name', $sessionname)->update($data1);
					$tel = \think\Db::name('atfck')->field('dianhua,count(dianhua)')->group('dianhua')->select();
					$this->assign('tel', $tel);
					$patientLists = \think\Db::name('atfck')->order('id DESC')->paginate(15);
					if(request()->isGet()){
						$btime = input('begintime');
						$begintime = $btime . ' 00:00:00';
						$begintimeend = $btime . ' 23:59:59';
						$etime = input('endtime');
						$endtimebegin = $etime . ' 00:00:00';
						$endtime = $etime . ' 23:59:59';
						$kefu = input('kefu');
						$tel = input('tel');

						if($btime && !$etime){
							$patientLists = \think\Db::name('atfck')
								->where('tjtime','>', $begintime)
								->where('tjtime','<', $begintimeend)
								->order('id', 'desc')->paginate(15);
						}
						if(!$btime && $etime){
							$patientLists = \think\Db::name('atfck')
								->where('tjtime','>', $endtimebegin)
								->where('tjtime','<', $endtime)
								->order('id', 'desc')->paginate(15);
						}
						if($btime && $etime){
							$patientLists = \think\Db::name('atfck')
								->where('tjtime','>', $begintime)
								->where('tjtime','<', $endtime)
								->order('id', 'desc')->paginate(15);
						}
						if($kefu){
							$kefu = '%' . $kefu . '%';
							$patientLists = \think\Db::name('atfck')
								->where('kefuname', 'like', $kefu)
								->order('id', 'desc')->paginate(15);
						}
						if($tel){
							$tel = '%' . $tel . '%';
							$patientLists = \think\Db::name('atfck')
								->where('dianhua', 'like', $tel)
								->order('id', 'desc')->paginate(15);
						}
					}
					$this->assign('patientLists', $patientLists);
					return $this->fetch();
				}
			}else{
				echo "<script>alert('请点击左侧栏目进入');history.go(-1)</script>";
			}
		}else{
			$tel = \think\Db::name('atfck')->field('dianhua,count(dianhua)')->group('dianhua')->select();
			$this->assign('tel', $tel);
			$patientLists = \think\Db::name('atfck')->order('id DESC')->paginate(15);
			if(request()->isGet()){
				$btime = input('begintime');
				$begintime = $btime . ' 00:00:00';
				$begintimeend = $btime . ' 23:59:59';
				$etime = input('endtime');
				$endtimebegin = $etime . ' 00:00:00';
				$endtime = $etime . ' 23:59:59';
				$kefu = input('kefu');
				$tel = input('tel');

				if($btime && !$etime){
					$patientLists = \think\Db::name('atfck')
						->where('tjtime','>', $begintime)
						->where('tjtime','<', $begintimeend)
						->order('id', 'desc')->paginate(15);
				}
				if(!$btime && $etime){
					$patientLists = \think\Db::name('atfck')
						->where('tjtime','>', $endtimebegin)
						->where('tjtime','<', $endtime)
						->order('id', 'desc')->paginate(15);
				}
				if($btime && $etime){
					$patientLists = \think\Db::name('atfck')
						->where('tjtime','>', $begintime)
						->where('tjtime','<', $endtime)
						->order('id', 'desc')->paginate(15);
				}
				if($kefu){
					$kefu = '%' . $kefu . '%';
					$patientLists = \think\Db::name('atfck')
						->where('kefuname', 'like', $kefu)
						->order('id', 'desc')->paginate(15);
				}
				if($tel){
					$tel = '%' . $tel . '%';
					$patientLists = \think\Db::name('atfck')
						->where('dianhua', 'like', $tel)
						->order('id', 'desc')->paginate(15);
				}
			}
			$this->assign('patientLists', $patientLists);
			return $this->fetch();
		}
	}

	public function listsblack(){
		$sessionname = session('name');
		$sessiontype = session('type');
		if($sessiontype != 1){
			echo "<script>alert('您不是管理员');history.go(-1)</script>";
		}else{
			$tel = \think\Db::name('atfck')->field('dianhua,count(dianhua)')->group('dianhua')->select();
			$this->assign('tel', $tel);
			$patientLists = \think\Db::name('atfck')->where('black',1)->order('id DESC')->paginate(15);
			if(request()->isGet()){
				$btime = input('begintime');
				$begintime = $btime . ' 00:00:00';
				$begintimeend = $btime . ' 23:59:59';
				$etime = input('endtime');
				$endtimebegin = $etime . ' 00:00:00';
				$endtime = $etime . ' 23:59:59';
				$kefu = input('kefu');
				$tel = input('tel');

				if($btime && !$etime){
					$patientLists = \think\Db::name('antaibao')
						->where('black',1)
						->where('tjtime','>', $begintime)
						->where('tjtime','<', $begintimeend)
						->order('id', 'desc')->paginate(15);
				}
				if(!$btime && $etime){
					$patientLists = \think\Db::name('antaibao')
						->where('black',1)
						->where('tjtime','>', $endtimebegin)
						->where('tjtime','<', $endtime)
						->order('id', 'desc')->paginate(15);
				}
				if($btime && $etime){
					$patientLists = \think\Db::name('antaibao')
						->where('black',1)
						->where('tjtime','>', $begintime)
						->where('tjtime','<', $endtime)
						->order('id', 'desc')->paginate(15);
				}
				if($kefu){
					$kefu = '%' . $kefu . '%';
					$patientLists = \think\Db::name('antaibao')
						->where('black',1)
						->where('kefuname', 'like', $kefu)
						->order('id', 'desc')->paginate(15);
				}
				if($tel){
					$tel = '%' . $tel . '%';
					$patientLists = \think\Db::name('antaibao')
						->where('black',1)
						->where('dianhua', 'like', $tel)
						->order('id', 'desc')->paginate(15);
				}
			}
			$this->assign('patientLists', $patientLists);
			return $this->fetch();
		}
	}

	public function listsAjax(){
		$patientLists = \think\Db::name('atfck')->where('black', 0)->where('queren', 0)->order('id DESC')->paginate();
		$this->assign('patientLists', $patientLists);
		return $patientLists;
	}

	public function edit(){
		$id = input('id');
		$shtime = date('Y-m-d H:i:s', time());
		$patientLists = db('atfck')->find($id);
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
			$res = \think\Db::name('atfck')->update($data);
			if($res){
//				return $this->success('修改成功', 'lists');
//				return $this->success('修改成功');
				echo "<script>alert('处理成功');history.go(-2)</script>";
			}else{
				return $this->error('处理失败');
			}
		}
		return $this->fetch();
	}

	public function del(){
		return $this->fetch();
	}

	//black
	//根据ip加入黑名单
	public function blackip(){
		$ip = input('ip');
		$data3 = [
			'black' => '1',
			'extend' => 'ip',
		];
		$res = \think\Db::name('atfck')->where('ip', $ip)->update($data3);
		if($res){
			return '加入黑名单成功！';
		}else{
			return '加入黑名单失败！';
		}
	}
	//根据电话加入黑名单
	public function blacktel(){
		$tel = input('tel');
		$data3 = [
			'black' => '1',
			'extend' => 'tel',
		];
		$res = \think\Db::name('atfck')->where('dianhua', $tel)->update($data3);
		if($res){
			return '加入黑名单成功！';
		}else{
			return '加入黑名单失败！';
		}
	}
	//根据url加入黑名单
	public function blackurl(){
		$url = input('url');
		$data3 = [
			'black' => '1',
			'extend' => 'url',
		];
		$res = \think\Db::name('atfck')->where('url', $url)->update($data3);
		if($res){
			return '加入黑名单成功！';
		}else{
			return '加入黑名单失败！';
		}
	}

	//white
	//根据ip解除黑名单
	public function whiteip(){
		$ip = input('ip');
		$data3 = [
			'black' => '0',
			'extend' => 'ip',
		];
		$res = \think\Db::name('atfck')->where('ip', $ip)->update($data3);
		if($res){
			return '解除黑名单成功！';
		}else{
			return '解除黑名单失败！';
		}
	}
	//根据电话解除黑名单
	public function whitetel(){
		$tel = input('tel');
		$data3 = [
			'black' => '0',
			'extend' => 'tel',
		];
		$res = \think\Db::name('atfck')->where('dianhua', $tel)->update($data3);
		if($res){
			return '解除黑名单成功！';
		}else{
			return '解除黑名单失败！';
		}
	}
	//根据url解除黑名单
	public function whiteurl(){
		$url = input('url');
		$data3 = [
			'black' => '0',
			'extend' => 'url',
		];
		$res = \think\Db::name('atfck')->where('url', $url)->update($data3);
		if($res){
			return '解除黑名单成功！';
		}else{
			return '解除黑名单失败！';
		}
	}

}