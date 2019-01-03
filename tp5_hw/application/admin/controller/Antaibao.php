<?php
namespace app\admin\controller;
use think\Controller;

class Antaibao extends Basic {
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
					$tel = \think\Db::name('antaibao')->field('dianhua,count(dianhua)')->group('dianhua')->select();
					$this->assign('tel', $tel);
					$patientLists = \think\Db::name('antaibao')->where('black','<>',1)->order('id DESC')->paginate(15);
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
								->where('black','<>',1)
								->where('tjtime','>', $begintime)
								->where('tjtime','<', $begintimeend)
								->order('id', 'desc')->paginate(15);
						}
						if(!$btime && $etime){
							$patientLists = \think\Db::name('antaibao')
								->where('black','<>',1)
								->where('tjtime','>', $endtimebegin)
								->where('tjtime','<', $endtime)
								->order('id', 'desc')->paginate(15);
						}
						if($btime && $etime){
							$patientLists = \think\Db::name('antaibao')
								->where('black','<>',1)
								->where('tjtime','>', $begintime)
								->where('tjtime','<', $endtime)
								->order('id', 'desc')->paginate(15);
						}
						if($kefu){
							$kefu = '%' . $kefu . '%';
							$patientLists = \think\Db::name('antaibao')
								->where('black','<>',1)
								->where('kefuname', 'like', $kefu)
								->order('id', 'desc')->paginate(15);
						}
						if($tel){
							$tel = '%' . $tel . '%';
							$patientLists = \think\Db::name('antaibao')
								->where('black','<>',1)
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
			$tel = \think\Db::name('antaibao')->field('dianhua,count(dianhua)')->group('dianhua')->select();
			$this->assign('tel', $tel);
			$patientLists = \think\Db::name('antaibao')->where('black','<>','1')->order('id DESC')->paginate(15);
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
						->where('black','<>',1)
						->where('tjtime','>', $begintime)
						->where('tjtime','<', $begintimeend)
						->order('id', 'desc')->paginate(15);
				}
				if(!$btime && $etime){
					$patientLists = \think\Db::name('antaibao')
						->where('black','<>',1)
						->where('tjtime','>', $endtimebegin)
						->where('tjtime','<', $endtime)
						->order('id', 'desc')->paginate(15);
				}
				if($btime && $etime){
					$patientLists = \think\Db::name('antaibao')
						->where('black','<>',1)
						->where('tjtime','>', $begintime)
						->where('tjtime','<', $endtime)
						->order('id', 'desc')->paginate(15);
				}
				if($kefu){
					$kefu = '%' . $kefu . '%';
					$patientLists = \think\Db::name('antaibao')
						->where('black','<>',1)
						->where('kefuname', 'like', $kefu)
						->order('id', 'desc')->paginate(15);
				}
				if($tel){
					$tel = '%' . $tel . '%';
					$patientLists = \think\Db::name('antaibao')
						->where('black','<>',1)
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
			$tel = \think\Db::name('antaibao')->field('dianhua,count(dianhua)')->group('dianhua')->select();
			$this->assign('tel', $tel);
			$patientLists = \think\Db::name('antaibao')->where('black',1)->order('id DESC')->paginate(15);
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
		$patientLists = \think\Db::name('antaibao')->where('black', 0)->where('queren', 0)->order('id DESC')->paginate();
		$this->assign('patientLists', $patientLists);
		return $patientLists;
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
				echo "<script>alert('处理成功');history.go(-2)</script>";
			}else{
				return $this->error('审核失败');
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
		$res = \think\Db::name('antaibao')->where('ip', $ip)->update($data3);
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
		$res = \think\Db::name('antaibao')->where('dianhua', $tel)->update($data3);
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
		$res = \think\Db::name('antaibao')->where('url', $url)->update($data3);
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
		$res = \think\Db::name('antaibao')->where('ip', $ip)->update($data3);
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
		$res = \think\Db::name('antaibao')->where('dianhua', $tel)->update($data3);
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
		$res = \think\Db::name('antaibao')->where('url', $url)->update($data3);
		if($res){
			return '解除黑名单成功！';
		}else{
			return '解除黑名单失败！';
		}
	}

	//导出表
	public function out()
	{
		if(session('type') !== 1){
			echo "<script>alert('您不是管理员');history.go(-1)</script>";
		}else{
			if(request()->isPost()){
				$btime = input('begintime');
				$etime = input('endtime');
				$begintime = input('begintime') . ' 00:00:00';
				$endtime = input('endtime') . ' 23:59:59';
				$inittime = '2018-05-17 00:00:00';
				$nowtime = date('Y-m-d H:i:s', time());
				//导出
				$path = dirname(__FILE__); //找到当前脚本所在路径
				vendor("PHPExcel.PHPExcel.PHPExcel");
				vendor("PHPExcel.PHPExcel.Writer.IWriter");
				vendor("PHPExcel.PHPExcel.Writer.Abstract");
				vendor("PHPExcel.PHPExcel.Writer.Excel5");
				vendor("PHPExcel.PHPExcel.Writer.Excel2007");
				vendor("PHPExcel.PHPExcel.IOFactory");
				$objPHPExcel = new \PHPExcel();
				$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
				$objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
				if($btime == '' && $etime == ''){
					$sql = db('antaibao')->select();
				}else if($btime != '' && $etime != ''){
					$sql = db('antaibao')->where('tjtime', '>', $begintime)->where('tjtime', '<', $endtime)->select();
				}else if($btime != '' && $etime == ''){
					$sql = db('antaibao')->where('tjtime', '>', $begintime)->select();
				}else if($btime == '' && $etime != ''){
					$sql = db('antaibao')->where('tjtime', '<', $endtime)->select();
				}
				$filename = 'data';

				/*--------------设置表头信息------------------*/
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'ID')
					->setCellValue('B1', '提交时间')
					->setCellValue('C1', '审核时间')
					->setCellValue('D1', '审核客服')
					->setCellValue('E1', 'IP')
					->setCellValue('F1', 'IP城市')
					->setCellValue('G1', '电话')
					->setCellValue('H1', '电话归属地')
					->setCellValue('I1', '电话设备')
					->setCellValue('J1', '提交网址')
					->setCellValue('K1', '备注')
					->setCellValue('L1', '是否审核');

				/*--------------开始从数据库提取信息插入Excel表中------------------*/
				$i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
				$count = count($sql);  //计算有多少条数据
				for ($i = 2; $i <= $count + 1; $i++) {
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $sql[$i - 2]['id']);
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $sql[$i - 2]['tjtime']);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $sql[$i - 2]['shtime']);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $sql[$i - 2]['kefuname']);
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $sql[$i - 2]['ip']);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $sql[$i - 2]['ipadd']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $sql[$i - 2]['dianhua']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $sql[$i - 2]['padd']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $sql[$i - 2]['shebei']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, htmlspecialchars_decode($sql[$i - 2]['url']));
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $sql[$i - 2]['beizhu']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $sql[$i - 2]['queren']);
				}

				/*--------------下面是设置其他信息------------------*/
				$objPHPExcel->getActiveSheet()->setTitle('信息');      //设置sheet的名称
				$objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
				$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
				$PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");
				ob_end_clean();//清除缓冲区,避免乱码
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename='.$filename.'.xls');
				header('Cache-Control: max-age=0');
//				ob_clean();//关键
//				flush();//关键
				//表示在$path路径下面生成demo.xlsx文件
//				$PHPWriter->save("php://output");
				$objWriter->save("php://output");

			}
			return $this->fetch();
		}
	}
}