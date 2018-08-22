<?php
namespace app\admin\controller;
use think\Controller;

class Online extends Controller{
	public function online(){
		if(request()->isAjax()){
			$sessionname = session('name');
			$sessiontype = session('type');
			$online = \think\Db::name('admin')->where('online', '1')->field('name')->select();
//			if($sessiontype != 1 && $sessiontype != 3){
			if($sessiontype == 2){
				if($online){
					$onlinename = $online[0]['name'];
					if($sessionname === $onlinename){
						echo 'ok';
					}else{
						$confiminfo = '目前在线的是“'. $onlinename . '”，确认接班吗？';
						echo $confiminfo;
					}
				}else{
					$noonlineinfo = '目前无人在线，确认接班吗？';
					echo $noonlineinfo;
				}
			}else{
				echo 'admin';
			}
		}
	}

	public function onlineleft(){
		$sessionname = session('name');
		$data0 = [
			'online' => '0'
		];
		$data1 = [
			'online' => '1'
		];
		$res0 = \think\Db::name('admin')->where('name','<>', $sessionname)->update($data0);
		$res1 = \think\Db::name('admin')->where('name', $sessionname)->update($data1);
	}
}