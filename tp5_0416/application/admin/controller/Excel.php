<?php
namespace app\admin\controller;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Loader;
use think\Controller;
use PHPExcel_IOFactory;
use PHPExcel;

class Excel extends Basic {
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
					$sql = db('order')->where('del', 0)->select();
				}else if($btime != '' && $etime != ''){
					$sql = db('order')->where('del', 0)->where('djtime', '>', $begintime)->where('djtime', '<', $endtime)->select();
				}else if($btime != '' && $etime == ''){
					$sql = db('order')->where('del', 0)->where('djtime', '>', $begintime)->select();
				}else if($btime == '' && $etime != ''){
					$sql = db('order')->where('del', 0)->where('djtime', '<', $endtime)->select();
				}
				$filename = 'data';

				/*--------------设置表头信息------------------*/
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'ID')
					->setCellValue('B1', '姓名')
					->setCellValue('C1', '预约科室')
					->setCellValue('D1', '预约医生')
					->setCellValue('E1', '客服')
					->setCellValue('F1', '登记时间')
					->setCellValue('G1', '预约时间')
					->setCellValue('H1', '到诊时间')
					->setCellValue('I1', '是否到诊')
					->setCellValue('J1', '初诊复诊')
					->setCellValue('K1', '渠道')
					->setCellValue('L1', '病种')
					->setCellValue('M1', '年龄')
					->setCellValue('N1', '性别')
					->setCellValue('O1', '电话')
					->setCellValue('P1', '微信')
					->setCellValue('Q1', 'QQ')
					->setCellValue('R1', '地址')
					->setCellValue('S1', '婚否')
					->setCellValue('T1', '病情描述')
					->setCellValue('U1', '备注')
					->setCellValue('V1', '院区')
					->setCellValue('W1', '类别')
					->setCellValue('X1', '图片')
					->setCellValue('Y1', '聊天记录');

				/*--------------开始从数据库提取信息插入Excel表中------------------*/
				$i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
				$count = count($sql);  //计算有多少条数据
				for ($i = 2; $i <= $count + 1; $i++) {
					if($sql[$i - 2]['daozhen'] == 0){
						$sql[$i - 2]['daozhen'] = '未到诊';
					}else{
						$sql[$i - 2]['daozhen'] = '到诊';
					}
					if($sql[$i - 2]['czfz'] == 1){
						$sql[$i - 2]['czfz'] = '初诊';
					}else{
						$sql[$i - 2]['czfz'] = '复诊';
					}
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $sql[$i - 2]['id']);
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $sql[$i - 2]['name']);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $sql[$i - 2]['keshi']);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $sql[$i - 2]['doctor']);
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $sql[$i - 2]['kefu']);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $sql[$i - 2]['djtime']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $sql[$i - 2]['yytime']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $sql[$i - 2]['dztime']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $sql[$i - 2]['daozhen']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i - 2]['czfz']);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $sql[$i - 2]['qudao']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $sql[$i - 2]['disease']);
					$objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $sql[$i - 2]['age']);
					$objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $sql[$i - 2]['sex']);
					$objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $sql[$i - 2]['tel']);
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $sql[$i - 2]['weixin']);
					$objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $sql[$i - 2]['qq']);
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $sql[$i - 2]['address']);
					$objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $sql[$i - 2]['jiehun']);
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $sql[$i - 2]['desc']);
					$objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $sql[$i - 2]['beizhu']);
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $sql[$i - 2]['yuanqu']);
					$objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $sql[$i - 2]['type']);
					$objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $sql[$i - 2]['pic']);
					$objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $sql[$i - 2]['liaotian']);
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


	public function in()
	{
//		ini_set('memory_limit','-1');
		if(session('type') !== 1){
			echo "<script>alert('您不是管理员');history.go(-1)</script>";
		}else{
			if(request()->isPost()) {
				if (! empty ( $_FILES ['excel'] ['name'] )) {
					$tmp_file = $_FILES ['excel'] ['tmp_name'];
					$file_types = explode ( ".", $_FILES ['excel'] ['name'] );
					$file_type = $file_types [count ( $file_types ) - 1];
					/*判别是不是.xls文件，判别是不是excel文件*/
					if (strtolower ( $file_type ) != 'xls' && strtolower ( $file_type ) != 'xlsx' && strtolower ( $file_type ) != 'csv'){
						$this->error('不是Excel文件，请重新上传');
					}
					/*设置上传路径*/
					$savePath = ROOT_PATH . 'public' . DS . 'uploads/attachment/';
					/*以时间来命名上传的文件*/
					$str = date ( 'Ymdhis' );
					$file_name = $str . "." . $file_type;
					/*是否上传成功*/
					if (! copy ( $tmp_file, $savePath . $file_name )) {
						$this->error ( '上传失败' );
					}
					// 调用excel数据导入函数
					$data = $this->import_excel($savePath . $file_name,0);
					echo "<pre>";
					;exit;
				} else {
					$this->error('没有导入excel文件!');
				}
			}
			return $this->fetch();
		}
	}

	/**
	 *  数据导入
	 * @param string $file excel文件,详细地址
	 * @param string $sheet
	 * @return string   返回解析数据
	 * @throws PHPExcel_Exception
	 * @throws PHPExcel_Reader_Exception
	 */
	public function import_excel($file='', $sheet=0){
		$file = iconv("utf-8", "gb2312", $file);   //转码
		if(empty($file) OR !file_exists($file)) {
			die('file not exists!');
		}
		// 1.引入excel外部插件
//		require_once('../vendor/phpexcel/phpexcel.php');
		vendor("PHPExcel.PHPExcel.PHPExcel");
		vendor("PHPExcel.PHPExcel.Writer.IWriter");
		vendor("PHPExcel.PHPExcel.Writer.Abstract");
		vendor("PHPExcel.PHPExcel.Writer.Excel5");
		vendor("PHPExcel.PHPExcel.Writer.Excel2007");
		vendor("PHPExcel.PHPExcel.IOFactory");
		//include('PHPExcel.php');  //引入PHP EXCEL类
		$objRead = new \PHPExcel_Reader_Excel2007();   //建立reader对象
//		if(!$objRead->canRead($file)){
//			$objRead = new \PHPExcel_Reader_Excel5();
//			if(!$objRead->canRead($file)){
//				die('No Excel!');
//				$objReader = PHPExcel_IOFactory::createReader('CSV')
//					->setDelimiter(',')
//					->setInputEncoding('GBK')
//					->setEnclosure('"')
//					->setLineEnding("\r\n")
//					->setSheetIndex(0);
//				$objPHPExcel = $objReader->load($file);
//			}
//		}

		$cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA');

//		$obj = $objRead->load($file);  //建立excel对象
		$objReader = PHPExcel_IOFactory::createReader('CSV')
			->setDelimiter(',')
			->setInputEncoding('GBK')
			->setEnclosure('"')
			->setLineEnding("\r\n")
			->setSheetIndex(0);
		$obj = $objReader->load($file);
		$currSheet = $obj->getSheet($sheet);   //获取指定的sheet表
		$columnH = $currSheet->getHighestColumn();   //取得最大的列号
		$columnCnt = array_search($columnH, $cellName);
		$rowCnt = $currSheet->getHighestRow();   //获取总行数

		$data = array();
		for($_row=1; $_row<=$rowCnt; $_row++){  //读取内容
			for($_column=0; $_column<=26; $_column++){
				$cellId = $cellName[$_column].$_row;


				$cellValue = $currSheet->getCell($cellId)->getValue();

				//$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值
				if($cellValue instanceof PHPExcel_RichText){   //富文本转换字符串
					$cellValue = $cellValue->__toString();
				}

				$data[$_row][$cellName[$_column]] = $cellValue;
			}
		}

		//返回excel数据
		$newdata = array();
		$kefuList = array(
			'0'=> array('name'=>'陈丽红','id'=>7),
			'1'=> array('name'=>'鄢爱娥','id'=>8),
			'2'=> array('name'=>'徐雪燕','id'=>10),
			'3'=> array('name'=>'王欢','id'=>11),
			'4'=> array('name'=>'董俊','id'=>12),
			'5'=> array('name'=>'王雪芹','id'=>13),
		);
		for ($i=2; $i<=count($data); $i++){
			if($data[$i]['A'] == ''){
				$newdata['yuanqu'] = '';
			}else{
				$newdata['yuanqu'] = $data[$i]['A'];
			}
//			for($k=0; $k<count($kefuList); $k++){
//				if($kefuList[$k]['name'] == $data[$i]['B']){
//					$newdata['kefuid'] = $kefuList[$k]['id'];
//				}else{
//					$newdata['kefuid'] = 0;
//				}
//			}
			if($data[$i]['B'] == '陈丽红'){
				$newdata['kefu'] = '陈丽红';
				$newdata['kefuid'] = 7;
			}else if($data[$i]['B'] == '鄢爱娥' || $data[$i]['B'] == '嫣爱娥'){
				$newdata['kefu'] = '鄢爱娥';
				$newdata['kefuid'] = 8;
			}else if($data[$i]['B'] == '徐雪燕' || $data[$i]['B'] == '徐雪艳'){
				$newdata['kefu'] = '徐雪艳';
				$newdata['kefuid'] = 10;
			}else if($data[$i]['B'] == '王欢'){
				$newdata['kefu'] = '王欢';
				$newdata['kefuid'] = 11;
			}else if($data[$i]['B'] == '董俊'){
				$newdata['kefu'] = '董俊';
				$newdata['kefuid'] = 12;
			}else if($data[$i]['B'] == '王雪芹'){
				$newdata['kefu'] = '王雪芹';
				$newdata['kefuid'] = 13;
			}else if($data[$i]['B'] == '周小娟' || $data[$i]['B'] == '周晓娟'){
				$newdata['kefu'] = '周晓娟';
				$newdata['kefuid'] = 0;
			}else if($data[$i]['B'] == ''){
				$newdata['kefu'] = '';
				$newdata['kefuid'] = 0;
			}else{
				$newdata['kefu'] = $data[$i]['B'];
				$newdata['kefuid'] = 0;
			}
//			$newdata['id'] = $data[$i]['C'];
//			$newdata['id'] = substr($data[$i]['C'], -6, 10);
			if($data[$i]['C'] == ''){
				$newdata['yynum'] = '';
			}else{
				$newdata['yynum'] = $data[$i]['C'];
			}
			if($data[$i]['D'] == ''){
				$newdata['keshi'] = '';
			}else{
				$newdata['keshi'] = $data[$i]['D'];
			}
			if($data[$i]['E'] == 0 || $data[$i]['E'] == '1999-1-1'){
				$newdata['yytime'] = '';
				$newdata['yuyue'] = 0;
			}else{
				$newdata['yytime'] = date('Y-m-d H:i:s',strtotime($data[$i]['E']));
				$newdata['yuyue'] = 1;
			}
			$newdata['djtime'] = date('Y-m-d H:i:s',strtotime($data[$i]['F']));
			if($data[$i]['G'] == ''){
				$newdata['name'] = '';
			}else{
				$newdata['name'] = $data[$i]['G'];
			}
			if($data[$i]['H'] == ''){
				$newdata['sex'] = '';
			}else{
				$newdata['sex'] = $data[$i]['H'];
			}
			if($data[$i]['I'] == 0){
				$newdata['age'] = '';
			}else{
				$newdata['age'] = $data[$i]['I'];
			}
			if($data[$i]['J'] == ''){
				$newdata['jiehun'] = '';
			}else{
				$newdata['jiehun'] = $data[$i]['J'];
			}
			if($data[$i]['K'] == '初诊'){
				$newdata['czfz'] = 1;
			}else{
				$newdata['czfz'] = 2;
			}
			if($data[$i]['L'] == ''){
				$newdata['address'] = '';
			}else{
				$newdata['address'] = $data[$i]['L'];
			}
			if($data[$i]['M'] == ''){
				$newdata['tel'] = '';
			}else{
				$newdata['tel'] = $data[$i]['M'];
			}
			if($data[$i]['N'] == ''){
				$newdata['weixin'] = '';
			}else{
				$newdata['weixin'] = $data[$i]['N'];
			}
			if($data[$i]['O'] == 0){
				$newdata['qq'] = '';
			}else{
				$newdata['qq'] = $data[$i]['O'];
			}
			if($data[$i]['P'] == ''){
				$newdata['qudao'] = '';
			}else{
				$newdata['qudao'] = $data[$i]['P'];
			}
			if($data[$i]['Q'] == ''){
				$newdata['keywords'] = '';
				$newdata['disease'] = '';
			}else{
				$newdata['keywords'] = $data[$i]['Q'];
				$newdata['disease'] = $data[$i]['Q'];
			}
			if($data[$i]['R'] == ''){
				$newdata['doctor'] = '';
			}else{
				$newdata['doctor'] = $data[$i]['R'];
			}
			if($data[$i]['S'] == '未诊'){
				$newdata['dztime'] = '';
				$newdata['daozhen'] = 0;
			}else{
				$newdata['dztime'] = date('Y-m-d H:i:s',strtotime($data[$i]['S']));
				$newdata['daozhen'] = 1;
			}
			if($data[$i]['T'] == ''){
				$newdata['liaotian'] = '';
			}else{
				$newdata['liaotian'] = $data[$i]['T'];
			}
			if($data[$i]['U'] == ''){
				$newdata['beizhu'] = '';
			}else{
				$newdata['beizhu'] = $data[$i]['U'];
			}
			if($data[$i]['V'] == ''){
				$newdata['desc'] = '';
			}else{
				$newdata['desc'] = $data[$i]['V'];
			}
			$newdata['xx'] = $data[$i]['W'];
			if($data[$i]['X'] == ''){
				$newdata['huifang'] = 0;
			}else{
				$newdata['huifang'] = $data[$i]['X'];
			}
			if($data[$i]['Y'] == 0){
				$newdata['hftime'] = '';
			}else{
				$newdata['hftime'] = $data[$i]['Y'];
			}
			if($data[$i]['Z'] == ''){
				$newdata['type'] = '';
			}else{
				$newdata['type'] = $data[$i]['Z'];
			}
			if(count($data[$i]) > 26){
				if($data[$i]['AA'] == ''){
					$newdata['pic'] = '';
				}else{
					$newdata['pic'] = $data[$i]['AA'];
				}
			}
			$res = db('order')->insert($newdata);
		}
		dump('导入成功');



//		return $data;
//		$res = db('oldinfo')->insert($data);
	}

	public function outnew()
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
					$sql = db('order')->select();
				}else if($btime != '' && $etime != ''){
					$sql = db('order')->where('djtime', '>', $begintime)->where('djtime', '<', $endtime)->select();
				}else if($btime != '' && $etime == ''){
					$sql = db('order')->where('djtime', '>', $begintime)->select();
				}else if($btime == '' && $etime != ''){
					$sql = db('order')->where('djtime', '<', $endtime)->select();
				}
				$filename = 'data';

				/*--------------设置表头信息------------------*/
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', '就诊院区')
					->setCellValue('B1', '客服')
					->setCellValue('C1', '预约号')
					->setCellValue('D1', '科室')
					->setCellValue('E1', '预约时间')
					->setCellValue('F1', '添加时间')
					->setCellValue('G1', '患者姓名')
					->setCellValue('H1', '性别')
					->setCellValue('I1', '年龄')
					->setCellValue('J1', '婚否')
					->setCellValue('K1', '就诊状态')
					->setCellValue('L1', '地址')
					->setCellValue('M1', '电话')
					->setCellValue('N1', '微信')
					->setCellValue('O1', 'QQ')
					->setCellValue('P1', '渠道')
					->setCellValue('Q1', '关键字')
					->setCellValue('R1', '预约医生')
					->setCellValue('S1', '是否就诊')
					->setCellValue('T1', '聊天记录')
					->setCellValue('U1', '备注')
					->setCellValue('V1', '病情描述')
					->setCellValue('W1', 'xx')
					->setCellValue('X1', '回访')
					->setCellValue('Y1', '回访时间')
					->setCellValue('Z1', '类别');

				/*--------------开始从数据库提取信息插入Excel表中------------------*/
				$i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
				$count = count($sql);  //计算有多少条数据
				for ($i = 2; $i <= $count + 1; $i++) {
					if($sql[$i - 2]['daozhen'] == 0){
						$sql[$i - 2]['daozhen'] = '未到诊';
					}else{
						$sql[$i - 2]['daozhen'] = '到诊';
					}
					if($sql[$i - 2]['czfz'] == 1){
						$sql[$i - 2]['czfz'] = '初诊';
					}else{
						$sql[$i - 2]['czfz'] = '复诊';
					}
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $sql[$i - 2]['yuanqu']);
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $sql[$i - 2]['kefu']);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $sql[$i - 2]['yynum']);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $sql[$i - 2]['keshi']);
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $sql[$i - 2]['yytime']);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $sql[$i - 2]['djtime']);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $sql[$i - 2]['name']);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $sql[$i - 2]['sex']);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $sql[$i - 2]['age']);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i - 2]['jiehun']);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $sql[$i - 2]['czfz']);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $sql[$i - 2]['address']);
					$objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $sql[$i - 2]['tel']);
					$objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $sql[$i - 2]['weixin']);
					$objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $sql[$i - 2]['qq']);
					$objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $sql[$i - 2]['qudao']);
					$objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $sql[$i - 2]['disease']);
					$objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $sql[$i - 2]['doctor']);
					$objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $sql[$i - 2]['daozhen']);
					$objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $sql[$i - 2]['liaotian']);
					$objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $sql[$i - 2]['beizhu']);
					$objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $sql[$i - 2]['desc']);
					$objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $sql[$i - 2]['xx']);
					$objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $sql[$i - 2]['huifang']);
					$objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $sql[$i - 2]['hftime']);
					$objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $sql[$i - 2]['type']);
				}

				/*--------------下面是设置其他信息------------------*/
				$objPHPExcel->getActiveSheet()->setTitle('信息');      //设置sheet的名称
				$objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
				$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
				$PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");
				ob_end_clean();//清除缓冲区,避免乱码
				set_time_limit(0);
				ini_set("memory_limit","512M");
				header('Content-Type: application/vnd.ms-excel');
//				header('Content-Disposition: attachment;filename='.$filename.'.xls');
				header('Content-Disposition: attachment;filename='.$filename.'.csv');
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