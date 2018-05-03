<?php
namespace app\index\controller;
use think\Controller;

class Lists extends Basic
{
    public function index()
    {
//    	$cates = \think\Db::name('cate')->field('catename')->find(input('cateid'));
//    	var_dump($cates);
//    	$catename = $cates['catename'];
//    	var_dump($catename);
//    	$artres = \think\Db::name('article')->order('artid desc')->where('cateid', '=', input('cateid'))->paginate(2);
//    	var_dump($artres);
//    	$this->assign('artres', $artres);
//    	$this->assign('catename', $catename);
		return $this->fetch();
    }
}
