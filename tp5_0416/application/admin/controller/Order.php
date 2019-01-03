<?php
namespace app\admin\controller;
use think\Controller;

class Order extends Basic {
	//显示全部信息
	public function lists(){
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$this->assign('kefuList', $kefuList);
//		$orderList = \think\Db::name('order')->where('del', 0)->order('id', 'desc')->paginate(15);
		$orderList = \think\Db::name('order')->where('del', 0)->order('djtime', 'desc')->paginate(15);
//		$this->assign('orderList', $orderList);
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d', time());
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
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$yynum = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$czfz = input('czfz');

			if($btime && !$etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','>', $begintime)
					->where('djtime','<', $begintimeend)
					->order('djtime', 'desc')->paginate(15);
			}
			if(!$btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','>', $endtimebegin)
					->where('djtime','<', $endtime)
					->order('djtime', 'desc')->paginate(15);
			}
			if($btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','>', $begintime)
					->where('djtime','<', $endtime)
					->order('djtime', 'desc')->paginate(15);
			}
			if($kefu){
				$kefu = '%' . $kefu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('kefu', 'like', $kefu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($yynum){
				$yynum = '%' . $yynum . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yynum', 'like', $yynum)
					->order('djtime', 'desc')->paginate(15);
			}
			if($disease){
				$disease = '%' . $disease . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('disease', 'like', $disease)
					->order('djtime', 'desc')->paginate(15);
			}
			if($name){
				$name = '%' . $name . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('name', 'like', $name)
					->order('djtime', 'desc')->paginate(15);
			}
			if($beizhu){
				$beizhu = '%' . $beizhu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('beizhu',  'like', $beizhu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($tel){
				$tel = '%' . $tel . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('tel', 'like', $tel)
					->order('djtime', 'desc')->paginate(15);
			}
			if($weixin){
				$weixin = '%' . $weixin . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('weixin', 'like', $weixin)
					->order('djtime', 'desc')->paginate(15);
			}
			if($qq){
				$qq = '%' . $qq . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('qq', 'like', $qq)
					->order('djtime', 'desc')->paginate(15);
			}
			if($czfz){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('czfz', $czfz)
					->order('djtime', 'desc')->paginate(15);
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//回收站 删除的信息
	public function listsdel(){
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$this->assign('kefuList', $kefuList);
		$orderList = \think\Db::name('order')->where('del', 1)->order('djtime', 'desc')->paginate('15');
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$czfz = input('czfz');

			if($btime && !$etime){
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('djtime','>', $begintime)
					->where('djtime','<', $begintimeend)
					->order('djtime', 'desc')->paginate(15);
			}
			if(!$btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('djtime','>', $endtimebegin)
					->where('djtime','<', $endtime)
					->order('djtime', 'desc')->paginate(15);
			}
			if($btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('djtime','>', $begintime)
					->where('djtime','<', $endtime)
					->order('djtime', 'desc')->paginate(15);
			}
			if($kefu){
				$kefu = '%' . $kefu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('kefu', 'like', $kefu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($id){
				$id = '%' . $id . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('id', 'like', $id)
					->order('djtime', 'desc')->paginate(15);
			}
			if($disease){
				$disease = '%' . $disease . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('disease', 'like', $disease)
					->order('djtime', 'desc')->paginate(15);
			}
			if($name){
				$name = '%' . $name . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('name', 'like', $name)
					->order('djtime', 'desc')->paginate(15);
			}
			if($beizhu){
				$beizhu = '%' . $beizhu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('beizhu',  'like', $beizhu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($tel){
				$tel = '%' . $tel . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('tel', 'like', $tel)
					->order('djtime', 'desc')->paginate(15);
			}
			if($weixin){
				$weixin = '%' . $weixin . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('weixin', 'like', $weixin)
					->order('djtime', 'desc')->paginate(15);
			}
			if($qq){
				$qq = '%' . $qq . '%';
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('qq', 'like', $qq)
					->order('djtime', 'desc')->paginate(15);
			}
			if($czfz){
				$orderList = \think\Db::name('order')
					->where('del', 1)
					->where('czfz', $czfz)
					->order('djtime', 'desc')->paginate(15);
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//自己信息 自己的信息
	public function listsmyself(){
		$kefuid = session('id');
		$myselfdengji = \think\Db::name('order')->where('del', '0')->where('kefuid', $kefuid)->count();//总登记
		$orderList = \think\Db::name('order')->where('kefuid', $kefuid)->where('del', 0)->order('djtime', 'desc')->paginate(15);
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d', time());
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
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$huifang = input('huifang');
			$czfz = input('czfz');
			$halfyear = input('halfyear');
			$halfyeartime = date('Y-m-d H:i:s', time()-3600*24*150);

			if($huifang == 3 || $huifang == null){
				if($btime && !$etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $begintimeend)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if(!$btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $endtimebegin)
						->where('djtime','<', $endtime)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $endtime)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($kefu){
					$kefu = '%' . $kefu . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('kefu', 'like', $kefu)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($id){
					$id = '%' . $id . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('id', 'like', $id)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($disease){
					$disease = '%' . $disease . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('disease', 'like', $disease)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($name){
					$name = '%' . $name . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('name', 'like', $name)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($beizhu){
					$beizhu = '%' . $beizhu . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('beizhu',  'like', $beizhu)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($tel){
					$tel = '%' . $tel . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('tel', 'like', $tel)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($weixin){
					$weixin = '%' . $weixin . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('weixin', 'like', $weixin)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($qq){
					$qq = '%' . $qq . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('qq', 'like', $qq)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($czfz){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('czfz', $czfz)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($halfyear && !$btime && !$etime){
					$orderList1 = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','<', $halfyeartime)
						->order('djtime', 'desc')->paginate();
					$orderList2 = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>=', $halfyeartime)
						->order('djtime', 'desc')->paginate();
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','<', $halfyeartime)
						->order('djtime', 'desc');
					foreach ($orderList1 as $v1){
						foreach ($orderList2 as $v2){
							if($v1['name'] === $v2['name']){
								$orderList = $orderList->where('name', '<>', $v1['name']);
							}
							if(($v1['tel'] && $v2['tel'] && $v1['tel'] === $v2['tel'])){
								$orderList = $orderList->where('tel', '<>', $v1['tel']);
							}
						}
					}
					$orderList = $orderList->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($halfyear){
					if($btime && $etime){
						$orderList = \think\Db::name('order')
							->where('del', 0)
							->where('kefuid', $kefuid)
							->where('djtime','<', $halfyeartime)
							->where('djtime','>', $btime)
							->where('djtime','<', $etime)
							->order('djtime', 'desc');
					}
					if(!$btime && !$etime){
						$orderList = \think\Db::name('order')
							->where('del', 0)
							->where('kefuid', $kefuid)
							->where('djtime','<', $halfyeartime)
							->order('djtime', 'desc');
					}
					if($btime && !$etime){
						$orderList = \think\Db::name('order')
							->where('del', 0)
							->where('kefuid', $kefuid)
							->where('djtime','<', $halfyeartime)
							->where('djtime','>', $btime)
							->order('djtime', 'desc');
					}
					if(!$btime && $etime){
						$orderList = \think\Db::name('order')
							->where('del', 0)
							->where('kefuid', $kefuid)
							->where('djtime','<', $halfyeartime)
							->where('djtime','<', $etime)
							->order('djtime', 'desc');
					}
					$orderList1 = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','<', $halfyeartime)
						->order('djtime', 'desc')->paginate();
					$orderList2 = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>=', $halfyeartime)
						->order('djtime', 'desc')->paginate();

					foreach ($orderList1 as $v1){
						foreach ($orderList2 as $v2){
							if($v1['name'] === $v2['name']){
								$orderList = $orderList->where('name', '<>', $v1['name']);
							}
							if(($v1['tel'] && $v2['tel'] && $v1['tel'] === $v2['tel'])){
								$orderList = $orderList->where('tel', '<>', $v1['tel']);
							}
						}
					}
					$orderList = $orderList->paginate(15);
					$myselfdengji = $orderList->count();
				}
			}else{
				if($btime && !$etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $begintimeend)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if(!$btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $endtimebegin)
						->where('djtime','<', $endtime)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if($btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $endtime)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
				if(!$btime && !$etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
					$myselfdengji = $orderList->count();
				}
			}
		}
		$this->assign([
			'orderList'=> $orderList,
			'myselfdengji'=> $myselfdengji,

		]);
		return $this->fetch();
	}

	public function listsmyselfajax()	{
		$kefuid = session('id');
		$orderList = \think\Db::name('order')->where('kefuid', $kefuid)->where('del', 0)->where('huifang', 4)->select();
		$this->assign('orderList', $orderList);
		return $orderList;
	}

	//今日登记 今天登记的信息
	public function listsaddtoday(){
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$this->assign('kefuList', $kefuList);
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d",time()+3600*24);
		$orderList = \think\Db::name('order')->where('del', 0)->where('djtime', 'between', [$datebegin, $dateend])->order('djtime', 'desc')->paginate(15);
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d', time());
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
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$czfz = input('czfz');

			if($btime && !$etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','between', [$begintime,$begintimeend])
					->order('djtime', 'desc')->paginate(15);
			}
			if(!$btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','between', [$endtimebegin,$endtime])
					->order('djtime', 'desc')->paginate(15);
			}
			if($btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('djtime','between', [$begintime,$endtime])
					->order('djtime', 'desc')->paginate(15);
			}
			if($kefu){
				$kefu = '%' . $kefu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('kefu', 'like', $kefu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($id){
				$id = '%' . $id . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('id', 'like', $id)
					->order('djtime', 'desc')->paginate(15);
			}
			if($disease){
				$disease = '%' . $disease . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('disease', 'like', $disease)
					->order('djtime', 'desc')->paginate(15);
			}
			if($name){
				$name = '%' . $name . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('name', 'like', $name)
					->order('djtime', 'desc')->paginate(15);
			}
			if($beizhu){
				$beizhu = '%' . $beizhu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('beizhu',  'like', $beizhu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($tel){
				$tel = '%' . $tel . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('tel', 'like', $tel)
					->order('djtime', 'desc')->paginate(15);
			}
			if($weixin){
				$weixin = '%' . $weixin . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('weixin', 'like', $weixin)
					->order('djtime', 'desc')->paginate(15);
			}
			if($qq){
				$qq = '%' . $qq . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('qq', 'like', $qq)
					->order('djtime', 'desc')->paginate(15);
			}
			if($czfz){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('czfz', $czfz)
					->order('djtime', 'desc')->paginate(15);
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//今日预约的信息
	public function listsordertoday(){
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$this->assign('kefuList', $kefuList);
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d 23:59:59", time());
		$orderList = \think\Db::name('order')->where('del', 0)->where('yuyue', 1)->where('yytime', 'between', [$datebegin, $dateend])->order('djtime', 'desc')->paginate(15);
		if(request()->isAjax()){
			$id = input('id');
			$daozhen = input('daozhen');
			$dztime = date('Y-m-d', time());
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
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$czfz = input('czfz');

			if($btime && !$etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('yytime','between', [$btime,$begintimeend])
					->order('djtime', 'desc')->paginate(15);
			}
			if(!$btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('yytime','between', [$etime,$endtime])
					->order('djtime', 'desc')->paginate(15);
			}
			if($btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('yytime','between', [$btime,$etime])
					->order('djtime', 'desc')->paginate(15);
			}
			if($kefu){
				$kefu = '%' . $kefu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('kefu', 'like', $kefu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($id){
				$id = '%' . $id . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('id', 'like', $id)
					->order('djtime', 'desc')->paginate(15);
			}
			if($disease){
				$disease = '%' . $disease . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('disease', 'like', $disease)
					->order('djtime', 'desc')->paginate(15);
			}
			if($name){
				$name = '%' . $name . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('name', 'like', $name)
					->order('djtime', 'desc')->paginate(15);
			}
			if($beizhu){
				$beizhu = '%' . $beizhu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('beizhu',  'like', $beizhu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($tel){
				$tel = '%' . $tel . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('tel', 'like', $tel)
					->order('djtime', 'desc')->paginate(15);
			}
			if($weixin){
				$weixin = '%' . $weixin . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('weixin', 'like', $weixin)
					->order('djtime', 'desc')->paginate(15);
			}
			if($qq){
				$qq = '%' . $qq . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('qq', 'like', $qq)
					->order('djtime', 'desc')->paginate(15);
			}
			if($czfz){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('yuyue', 1)
					->where('czfz', $czfz)
					->order('djtime', 'desc')->paginate(15);
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	//今日到诊
	public function listsdztoday(){
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$this->assign('kefuList', $kefuList);
		$datebegin = date("Y-m-d",time());
		$dateend = date("Y-m-d 23:59:59",time());
		$orderList = \think\Db::name('order')->where('del', 0)->where('daozhen', 1)->where('dztime', 'between', [$datebegin, $dateend])->order('djtime', 'desc')->paginate(15);
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$czfz = input('czfz');

			if($btime && !$etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('dztime','between', [$btime,$begintimeend])
					->order('djtime', 'desc')->paginate(15);
			}
			if(!$btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('dztime','between', [$etime,$endtime])
					->order('djtime', 'desc')->paginate(15);
			}
			if($btime && $etime){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('dztime','between', [$btime,$etime])
					->order('djtime', 'desc')->paginate(15);
			}
			if($kefu){
				$kefu = '%' . $kefu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('kefu', 'like', $kefu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($id){
				$id = '%' . $id . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('id', 'like', $id)
					->order('djtime', 'desc')->paginate(15);
			}
			if($disease){
				$disease = '%' . $disease . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('disease', 'like', $disease)
					->order('djtime', 'desc')->paginate(15);
			}
			if($name){
				$name = '%' . $name . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('name', 'like', $name)
					->order('djtime', 'desc')->paginate(15);
			}
			if($beizhu){
				$beizhu = '%' . $beizhu . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('beizhu',  'like', $beizhu)
					->order('djtime', 'desc')->paginate(15);
			}
			if($tel){
				$tel = '%' . $tel . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('tel', 'like', $tel)
					->order('djtime', 'desc')->paginate(15);
			}
			if($weixin){
				$weixin = '%' . $weixin . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('weixin', 'like', $weixin)
					->order('djtime', 'desc')->paginate(15);
			}
			if($qq){
				$qq = '%' . $qq . '%';
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('qq', 'like', $qq)
					->order('djtime', 'desc')->paginate(15);
			}
			if($czfz){
				$orderList = \think\Db::name('order')
					->where('del', 0)
					->where('daozhen', 1)
					->where('czfz', $czfz)
					->order('djtime', 'desc')->paginate(15);
			}
		}
		$this->assign('orderList', $orderList);
		return $this->fetch();
	}

	public function tel(){
		if(request()->isAjax()){
			$tel = input('tel');
			$orderList = \think\Db::name('order')->where('del', 0)->where('tel', $tel)->order('id', 'desc')->find();
			return $orderList;
		}
	}
	public function name(){
		if(request()->isAjax()){
			$name = input('name');
			$orderList = \think\Db::name('order')->where('del', 0)->where('name', $name)->order('id', 'desc')->find();
			return $orderList;
		}
	}

	public function add(){
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$userList = \think\Db::name('admin')->select();
		$this->assign('kefuList', $kefuList);
		if(request()->isPost()){
			$lastid = \think\Db::name('order')->order('id', 'desc')->field('id')->paginate(1);
			$lastid = $lastid[0]['id'];
			$yynum = $lastid + 1;
			$djtime = date('Y-m-d H:i:s', time());
			$yytime = input('yytime');
			$dztime = input('dztime');
			$kefu = input('kefu');
			for($i=0; $i<count($userList); $i++){
				if($userList[$i]['name'] == $kefu){
					$kefuid = $userList[$i]['id'];
				}
			}
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
				'yynum' => $yynum,
				'name' => input('name'),
				'sex' => input('sex'),
				'age' => input('age'),
//				'djtime' => input('djtime'),
				'djtime' => $djtime,
				'xgtime' => $djtime,
				'yytime' => input('yytime'),
				'dztime' => input('dztime'),
				'hftime' => input('hftime'),
				'huifang' => input('huifang'),
				'kefu' => input('kefu'),
				'kefuid' => $kefuid,
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
//				'liaotian' => input('liaotian'),
				'liaotian' => filterEmoji(input('liaotian')),
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
		}
		return $this->fetch();
	}

	public function edit(){
		$id = input('id');
		$orderList = db('order')->where('id', $id)->find();
		$this->assign('orderList', $orderList);
		if(request()->isPost()){
			$xgtime = date('Y-m-d H:i', time());
			$yytime = input('yytime');
			$dztime = input('dztime');
			$referrer = input('referrer');
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
				'hftime' => input('hftime'),
				'huifang' => input('huifang'),
				'desc' => input('desc'),
				'beizhu' => input('beizhu'),
				'yuyue' => $yuyue,
				'daozhen' => $daozhen,
				'czfz' => input('czfz'),
				'keshi' => input('keshi'),
				'doctor' => input('doctor'),
//				'tel' => input('tel'),
//				'weixin' => input('weixin'),
//				'qq' => input('qq'),
				'address' => input('address'),
				'jiehun' => input('jiehun'),
//				'liaotian' => input('liaotian'),
				'liaotian' => filterEmoji(input('liaotian')),
				'yuanqu' => input('yuanqu'),
				'type' => input('type'),
			];
			$validate = \think\Loader::validate('order');
			$res = \think\Db::name('order')->where('id', $id)->update($data);
			if($res){
//				$this->success('修改成功', 'lists');
				echo "<script>alert('修改成功');window.location.href='$referrer'</script>";
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

	//test
	public function test(){
//		$kefuid = session('id');
		$kefuid = 8;
		$kefuList = \think\Db::name('admin')->where('type','<>','1')->where('id','<>','4')->order('id', 'asc')->select();
		$this->assign('kefuList', $kefuList);
		$myselfdengji = \think\Db::name('order')->where('del', '0')->where('kefuid', $kefuid)->count();//总登记
		$orderList = \think\Db::name('order')->where('kefuid', $kefuid)->where('del', 0)->order('djtime', 'desc')->paginate(15);
		if(request()->isGet()){
			$btime = input('begintime');
			$begintime = $btime . ' 00:00:00';
			$begintimeend = $btime . ' 23:59:59';
			$etime = input('endtime');
			$endtimebegin = $etime . ' 00:00:00';
			$endtime = $etime . ' 23:59:59';
			$kefu = input('kefu');
			$id = input('yynum');
			$disease = input('disease');
			$name = input('name');
			$beizhu = input('beizhu');
			$tel = input('tel');
			$weixin = input('weixin');
			$qq = input('qq');
			$huifang = input('huifang');
			$czfz = input('czfz');
			$halfyear = input('halfyear');
			$halfyeartime = date('Y-m-d H:i:s', time()-3600*24*150);

			if($huifang == 3 || $huifang == null){
				if($btime && !$etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $begintimeend)
						->order('djtime', 'desc')->paginate(15);
				}
				if(!$btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $endtimebegin)
						->where('djtime','<', $endtime)
						->order('djtime', 'desc')->paginate(15);
				}
				if($btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $endtime)
						->order('djtime', 'desc')->paginate(15);
				}
				if($kefu){
					$kefu = '%' . $kefu . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('kefu', 'like', $kefu)
						->order('djtime', 'desc')->paginate(15);
				}
				if($id){
					$id = '%' . $id . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('id', 'like', $id)
						->order('djtime', 'desc')->paginate(15);
				}
				if($disease){
					$disease = '%' . $disease . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('disease', 'like', $disease)
						->order('djtime', 'desc')->paginate(15);
				}
				if($name){
					$name = '%' . $name . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('name', 'like', $name)
						->order('djtime', 'desc')->paginate(15);
				}
				if($beizhu){
					$beizhu = '%' . $beizhu . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('beizhu',  'like', $beizhu)
						->order('djtime', 'desc')->paginate(15);
				}
				if($tel){
					$tel = '%' . $tel . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('tel', 'like', $tel)
						->order('djtime', 'desc')->paginate(15);
				}
				if($weixin){
					$weixin = '%' . $weixin . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('weixin', 'like', $weixin)
						->order('djtime', 'desc')->paginate(15);
				}
				if($qq){
					$qq = '%' . $qq . '%';
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('qq', 'like', $qq)
						->order('djtime', 'desc')->paginate(15);
				}
				if($czfz){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('czfz', $czfz)
						->order('djtime', 'desc')->paginate(15);
				}
				if($halfyear){
					$orderList1 = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','<', $halfyeartime)
						->order('djtime', 'desc')->paginate();
					$orderList2 = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>=', $halfyeartime)
						->order('djtime', 'desc')->paginate();
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','<', $halfyeartime)
						->order('djtime', 'desc');
					foreach ($orderList1 as $v1){
						foreach ($orderList2 as $v2){
							if($v1['name'] === $v2['name']){
								$orderList = $orderList->where('name', '<>', $v1['name']);
							}
							if(($v1['tel'] && $v2['tel'] && $v1['tel'] === $v2['tel'])){
								$orderList = $orderList->where('tel', '<>', $v1['tel']);
							}
						}
					}
					$orderList = $orderList->paginate(15);
				}
			}else{
				if($btime && !$etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $begintimeend)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
				}
				if(!$btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $endtimebegin)
						->where('djtime','<', $endtime)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
				}
				if($btime && $etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('djtime','>', $begintime)
						->where('djtime','<', $endtime)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
				}
				if(!$btime && !$etime){
					$orderList = \think\Db::name('order')
						->where('del', 0)
						->where('kefuid', $kefuid)
						->where('huifang', $huifang)
						->order('djtime', 'desc')->paginate(15);
				}
			}
		}
		$this->assign([
			'orderList'=> $orderList,
			'myselfdengji'=> $myselfdengji,

		]);
		return $this->fetch();
	}


}