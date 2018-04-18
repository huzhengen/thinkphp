<?php 
namespace app\admin\controller;
use think\Controller;

class Article extends Controller{
	public function lists(){
		return $this->fetch();
	}

	public function add(){
		
		return $this->fetch();
	}


}