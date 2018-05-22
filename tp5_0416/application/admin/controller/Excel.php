<?php
namespace app\admin\controller;
use think\Loader;
use think\Controller;
use PHPExcel_IOFactory;
use PHPExcel;

class Excel extends Basic {
	public function out()
	{
		if(session('id') !== 1){
			echo "<script>alert('您不是超级管理员');history.go(-1)</script>";
		}else{
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
			$sql = db('order')->select();
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
				->setCellValue('J1', '渠道')
				->setCellValue('K1', '病种')
				->setCellValue('L1', '年龄')
				->setCellValue('M1', '性别')
				->setCellValue('N1', '电话')
				->setCellValue('O1', '微信')
				->setCellValue('P1', 'QQ')
				->setCellValue('Q1', '地址')
				->setCellValue('R1', '婚否')
				->setCellValue('S1', '病情描述')
				->setCellValue('T1', '备注')
				->setCellValue('U1', '院区')
				->setCellValue('V1', '类别')
				->setCellValue('W1', '图片')
				->setCellValue('X1', '聊天记录');

			/*--------------开始从数据库提取信息插入Excel表中------------------*/
			$i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
			$count = count($sql);  //计算有多少条数据
			for ($i = 2; $i <= $count + 1; $i++) {
				if($sql[$i - 2]['daozhen'] == 0){
					$sql[$i - 2]['daozhen'] = '未到诊';
				}else if($sql[$i - 2]['daozhen'] == 1){
					$sql[$i - 2]['daozhen'] = '初诊';
				}else{
					$sql[$i - 2]['daozhen'] = '复诊';
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
				$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i - 2]['qudao']);
				$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $sql[$i - 2]['disease']);
				$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $sql[$i - 2]['age']);
				$objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $sql[$i - 2]['sex']);
				$objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $sql[$i - 2]['tel']);
				$objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $sql[$i - 2]['weixin']);
				$objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $sql[$i - 2]['qq']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $sql[$i - 2]['address']);
				$objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $sql[$i - 2]['jiehun']);
				$objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $sql[$i - 2]['desc']);
				$objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $sql[$i - 2]['beizhu']);
				$objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $sql[$i - 2]['yuanqu']);
				$objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $sql[$i - 2]['type']);
				$objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $sql[$i - 2]['pic']);
				$objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $sql[$i - 2]['liaotian']);
			}

			/*--------------下面是设置其他信息------------------*/
			$objPHPExcel->getActiveSheet()->setTitle('信息');      //设置sheet的名称
			$objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
			$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
			$PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");
			ob_end_clean();//清除缓冲区,避免乱码
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$filename.'.xlsx');
			header('Cache-Control: max-age=0');
			//表示在$path路径下面生成demo.xlsx文件
			$PHPWriter->save("php://output");
		}
	}
}