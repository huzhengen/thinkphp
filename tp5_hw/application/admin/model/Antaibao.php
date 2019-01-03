<?php
namespace app\admin\model;
use think\Model;

class Antaibao extends Model{
	public function lists(){
		$sql = "SELECT `dianhua`,COUNT(`dianhua`) AS c FROM `tp5_0416_antaibao` GROUP BY `dianhua` ORDER BY c DESC LIMIT 10";
		$Model = new \Model(); // 实例化一个model对象 没有对应任何数据表
		return $Model->query($sql);
	}
}