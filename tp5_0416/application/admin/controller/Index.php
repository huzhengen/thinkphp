<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Cookie;

class Index extends Basic
{
    public function index()
    {
    	$cachetime = 3600;
    	$id = session('id');
    	$startTime = \think\Db::name('order')->where('id', 1)->field('djtime')->cache($cachetime)->find();
	    $startTime = $startTime['djtime'];
	    $kefu7id = '7';
	    $kefu8id = '8';
	    $kefu10id = '10';
	    $kefu11id = '11';
	    $kefu12id = '12';
	    $kefu13id = '13';
	    $kefu7name = \think\Db::name('admin')->where('id', $kefu7id)->field('name')->cache($cachetime)->find();
	    $kefu8name = \think\Db::name('admin')->where('id', $kefu8id)->field('name')->cache($cachetime)->find();
	    $kefu10name = \think\Db::name('admin')->where('id', $kefu10id)->field('name')->cache($cachetime)->find();
	    $kefu11name = \think\Db::name('admin')->where('id', $kefu11id)->field('name')->cache($cachetime)->find();
	    $kefu12name = \think\Db::name('admin')->where('id', $kefu12id)->field('name')->cache($cachetime)->find();
	    $kefu13name = \think\Db::name('admin')->where('id', $kefu13id)->field('name')->cache($cachetime)->find();
	    $monthtime = date('Y-m-01 00:00:00');//本月月初时间
    	$yesterdaytime = date('Y-m-d 00:00:00', time()-24*3600);//昨天
    	$todaytime = date('Y-m-d 00:00:00', time());//今天
	    $nowtime = date('Y-m-d', time());
	    $tomorrowtime = date('Y-m-d 00:00:00', time()+24*3600);//明天
	    $allusers = \think\Db::name('order')->where('del', '0');
	    $request = Request::instance();
	    $ip = $request->ip();
	    $this->assign([
		    'nowtime' => $nowtime,
		    'ip' => $ip,
		    'kefu7name' => $kefu7name,
		    'kefu8name' => $kefu8name,
		    'kefu10name' => $kefu10name,
		    'kefu11name' => $kefu11name,
		    'kefu12name' => $kefu12name,
		    'kefu13name' => $kefu13name,
		    'startTime' => $startTime,
	    ]);



	    //myself个人的
	    $myselfdengjitoday = $allusers->where('kefuid', $id)->where('djtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();//今日登记
	    $myselfdengjiyesterday = $allusers->where('kefuid', $id)->where('djtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();//昨天登记
	    $myselfdengjimonth = $allusers->where('kefuid', $id)->where('djtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();//本月登记
	    $myselfdengji = $allusers->where('kefuid', $id)->cache($cachetime)->count();//总登记
	    $myselfyuyuetoday = $allusers->where('kefuid', $id)->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();//今日预约
	    $myselfyuyueyesterday = $allusers->where('kefuid', $id)->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();//昨日预约
	    $myselfyuyuemonth = $allusers->where('kefuid', $id)->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();//本月预约
	    $myselfyuyue = $allusers->where('kefuid', $id)->where('yuyue', '1')->cache($cachetime)->count();//总预约
	    $myselfdaozhentoday = $allusers->where('kefuid', $id)->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();//今日到诊
	    $myselfdaozhenyesterday = $allusers->where('kefuid', $id)->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();//昨日到诊
	    $myselfdaozhenmonth = $allusers->where('kefuid', $id)->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();//本月到诊
	    $myselfdaozhen = $allusers->where('kefuid', $id)->where('daozhen', '1')->cache($cachetime)->count();//总到诊
	    $this->assign([
	    	'myselfdengjitoday' => $myselfdengjitoday,
		    'myselfdengjiyesterday' => $myselfdengjiyesterday,
		    'myselfdengjimonth' => $myselfdengjimonth,
		    'myselfdengji' => $myselfdengji,
		    'myselfyuyuetoday' => $myselfyuyuetoday,
		    'myselfyuyueyesterday' => $myselfyuyueyesterday,
		    'myselfyuyuemonth' => $myselfyuyuemonth,
	        'myselfyuyue' => $myselfyuyue,
		    'myselfdaozhentoday' => $myselfdaozhentoday,
		    'myselfdaozhenyesterday' => $myselfdaozhenyesterday,
		    'myselfdaozhenmonth' => $myselfdaozhenmonth,
			'myselfdaozhen' => $myselfdaozhen,
	    ]);

	    //所有的
	    $allusersdengjitoday = $allusers->where('djtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();//今日登记
	    $allusersdengjiyesterday = $allusers->where('djtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();//昨天登记
	    $allusersdengjimonth = $allusers->where('djtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();//本月登记
	    $allusersdengji = $allusers->cache($cachetime)->count();//总登记
	    $allusersyuyuetoday = $allusers->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();//今日预约
	    $allusersyuyueyesterday = $allusers->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();//昨日预约
	    $allusersyuyuemonth = $allusers->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();//本月预约
	    $allusersyuyue = $allusers->where('yuyue', '1')->cache($cachetime)->count();//总预约
	    $allusersdaozhentoday = $allusers->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();//今日到诊
	    $allusersdaozhenyesterday = $allusers->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();//昨日到诊
	    $allusersdaozhenmonth = $allusers->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();//本月到诊
	    $allusersdaozhen = $allusers->where('daozhen', '1')->cache($cachetime)->count();//总到诊
	    $this->assign([
		    'allusersdengjitoday' => $allusersdengjitoday,
		    'allusersdengjiyesterday' => $allusersdengjiyesterday,
		    'allusersdengjimonth' => $allusersdengjimonth,
		    'allusersdengji' => $allusersdengji,
		    'allusersyuyuetoday' => $allusersyuyuetoday,
		    'allusersyuyueyesterday' => $allusersyuyueyesterday,
		    'allusersyuyuemonth' => $allusersyuyuemonth,
		    'allusersyuyue' => $allusersyuyue,
		    'allusersdaozhentoday' => $allusersdaozhentoday,
		    'allusersdaozhenyesterday' => $allusersdaozhenyesterday,
		    'allusersdaozhenmonth' => $allusersdaozhenmonth,
		    'allusersdaozhen' => $allusersdaozhen,
	    ]);

		//本月客服初诊排行
	    //初诊/月
	    $kefu7czmonth = $allusers->where('kefuid', $kefu7id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu8czmonth = $allusers->where('kefuid', $kefu8id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu10czmonth = $allusers->where('kefuid', $kefu10id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu11czmonth = $allusers->where('kefuid', $kefu11id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu12czmonth = $allusers->where('kefuid', $kefu12id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu13czmonth = $allusers->where('kefuid', $kefu13id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    //复诊/月
	    $kefu7fzmonth = $allusers->where('kefuid', $kefu7id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu8fzmonth = $allusers->where('kefuid', $kefu8id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu10fzmonth = $allusers->where('kefuid', $kefu10id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu11fzmonth = $allusers->where('kefuid', $kefu11id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu12fzmonth = $allusers->where('kefuid', $kefu12id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $kefu13fzmonth = $allusers->where('kefuid', $kefu13id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    //总到诊
	    $kefu7dz = $allusers->where('kefuid', $kefu7id)->where('daozhen', '1')->cache($cachetime)->count();
	    $kefu8dz = $allusers->where('kefuid', $kefu8id)->where('daozhen', '1')->cache($cachetime)->count();
	    $kefu10dz = $allusers->where('kefuid', $kefu10id)->where('daozhen', '1')->cache($cachetime)->count();
	    $kefu11dz = $allusers->where('kefuid', $kefu11id)->where('daozhen', '1')->cache($cachetime)->count();
	    $kefu12dz = $allusers->where('kefuid', $kefu12id)->where('daozhen', '1')->cache($cachetime)->count();
	    $kefu13dz = $allusers->where('kefuid', $kefu13id)->where('daozhen', '1')->cache($cachetime)->count();
	    //总预约
	    $kefu7yy = $allusers->where('kefuid', $kefu7id)->where('yuyue', '1')->cache($cachetime)->count();
	    $kefu8yy = $allusers->where('kefuid', $kefu8id)->where('yuyue', '1')->cache($cachetime)->count();
	    $kefu10yy = $allusers->where('kefuid', $kefu10id)->where('yuyue', '1')->cache($cachetime)->count();
	    $kefu11yy = $allusers->where('kefuid', $kefu11id)->where('yuyue', '1')->cache($cachetime)->count();
	    $kefu12yy = $allusers->where('kefuid', $kefu12id)->where('yuyue', '1')->cache($cachetime)->count();
	    $kefu13yy = $allusers->where('kefuid', $kefu13id)->where('yuyue', '1')->cache($cachetime)->count();
	    //总预约
	    $kefu7dj = $allusers->where('kefuid', $kefu7id)->cache($cachetime)->count();
	    $kefu8dj = $allusers->where('kefuid', $kefu8id)->cache($cachetime)->count();
	    $kefu10dj = $allusers->where('kefuid', $kefu10id)->cache($cachetime)->count();
	    $kefu11dj = $allusers->where('kefuid', $kefu11id)->cache($cachetime)->count();
	    $kefu12dj = $allusers->where('kefuid', $kefu12id)->cache($cachetime)->count();
	    $kefu13dj = $allusers->where('kefuid', $kefu13id)->cache($cachetime)->count();
	    $this->assign([
		    'kefu7czmonth' => $kefu7czmonth,
		    'kefu8czmonth' => $kefu8czmonth,
		    'kefu10czmonth' => $kefu10czmonth,
		    'kefu11czmonth' => $kefu11czmonth,
		    'kefu12czmonth' => $kefu12czmonth,
		    'kefu13czmonth' => $kefu13czmonth,
		    'kefu7fzmonth' => $kefu7fzmonth,
		    'kefu8fzmonth' => $kefu8fzmonth,
		    'kefu10fzmonth' => $kefu10fzmonth,
		    'kefu11fzmonth' => $kefu11fzmonth,
		    'kefu12fzmonth' => $kefu12fzmonth,
		    'kefu13fzmonth' => $kefu13fzmonth,
		    'kefu7dz' => $kefu7dz,
		    'kefu8dz' => $kefu8dz,
		    'kefu10dz' => $kefu10dz,
		    'kefu11dz' => $kefu11dz,
		    'kefu12dz' => $kefu12dz,
		    'kefu13dz' => $kefu13dz,
		    'kefu7yy' => $kefu7yy,
		    'kefu8yy' => $kefu8yy,
		    'kefu10yy' => $kefu10yy,
		    'kefu11yy' => $kefu11yy,
		    'kefu12yy' => $kefu12yy,
		    'kefu13yy' => $kefu13yy,
		    'kefu7dj' => $kefu7dj,
		    'kefu8dj' => $kefu8dj,
		    'kefu10dj' => $kefu10dj,
		    'kefu11dj' => $kefu11dj,
		    'kefu12dj' => $kefu12dj,
		    'kefu13dj' => $kefu13dj,
	    ]);

	    //安太宝留电
	    $antaibao = \think\Db::name('antaibao');
	    $antaibaotoday = $antaibao->where('black', 0)->where('tjtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();
	    $antaibaotodayyes = $antaibao->where('black', 0)->where('queren','<>', '0')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();
	    $antaibaotodayno = $antaibao->where('black', 0)->where('queren', '0')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();
	    $antaibaoyesterday = $antaibao->where('black', 0)->where('tjtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();
	    $antaibaoyesterdayyes = $antaibao->where('black', 0)->where('queren','<>', '0')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();
	    $antaibaoyesterdayno = $antaibao->where('black', 0)->where('queren', '0')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();
	    $antaibaomonth = $antaibao->where('black', 0)->where('tjtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $antaibaomonthyes = $antaibao->where('black', 0)->where('queren', '<>', '0')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $antaibaomonthno = $antaibao->where('black', 0)->where('queren', '0')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $antaibaoall = $antaibao->where('black', 0)->cache($cachetime)->count();
	    $antaibaoallyes = $antaibao->where('black', 0)->where('queren', '<>', '0')->cache($cachetime)->count();
	    $antaibaoallno = $antaibao->where('black', 0)->where('queren', '0')->cache($cachetime)->count();
	    $this->assign([
		    'antaibaotoday' => $antaibaotoday,
		    'antaibaotodayyes' => $antaibaotodayyes,
		    'antaibaotodayno' => $antaibaotodayno,
		    'antaibaoyesterday' => $antaibaoyesterday,
		    'antaibaoyesterdayyes' => $antaibaoyesterdayyes,
		    'antaibaoyesterdayno' => $antaibaoyesterdayno,
		    'antaibaomonth' => $antaibaomonth,
		    'antaibaomonthyes' => $antaibaomonthyes,
		    'antaibaomonthno' => $antaibaomonthno,
		    'antaibaoallyes' => $antaibaoallyes,
		    'antaibaoallno' => $antaibaoallno,
		    'antaibaoall' => $antaibaoall,
	    ]);

	    //网站自助预约（挂号）数据统计
	    $form = \think\Db::name('atfck');
	    $formtoday = $form->where('tjtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();
	    $formtodayyes = $form->where('queren', '<>', '0')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();
	    $formtodayno = $form->where('queren', '0')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->cache($cachetime)->count();
	    $formyesterday = $form->where('tjtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();
	    $formyesterdayyes = $form->where('queren', '<>', '0')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();
	    $formyesterdayno = $form->where('queren', '0')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->cache($cachetime)->count();
	    $formmonth = $form->where('tjtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $formmonthyes = $form->where('queren', '<>', '0')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $formmonthno = $form->where('queren', '0')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->cache($cachetime)->count();
	    $formall = $form->cache($cachetime)->count();
	    $formallyes = $form->where('queren', '<>', '0')->cache($cachetime)->count();
	    $formallno = $form->where('queren', '0')->cache($cachetime)->count();
	    $this->assign([
		    'formtoday' => $formtoday,
		    'formtodayyes' => $formtodayyes,
		    'formtodayno' => $formtodayno,
		    'formyesterday' => $formyesterday,
		    'formyesterdayyes' => $formyesterdayyes,
		    'formyesterdayno' => $formyesterdayno,
		    'formmonth' => $formmonth,
		    'formmonthyes' => $formmonthyes,
		    'formmonthno' => $formmonthno,
		    'formallyes' => $formallyes,
		    'formallno' => $formallno,
		    'formall' => $formall,
	    ]);



//	    //客服统计预约到诊----------------------------------------------
//	    //客服7  id7  陈丽红
//	    $kefu7 = \think\Db::name('order')->where('del', '0');
//	    $kefu7dengjitoday = $kefu7->where('kefuid', $kefu7id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
//	    $kefu7dengjiyesterday = $kefu7->where('kefuid', $kefu7id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
//	    $kefu7dengjimonth = $kefu7->where('kefuid', $kefu7id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
//	    $kefu7dengji = $kefu7->where('kefuid', $kefu7id )->count();//总登记
//	    $kefu7yuyuetoday = $kefu7->where('kefuid', $kefu7id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
//	    $kefu7yuyueyesterday = $kefu7->where('kefuid', $kefu7id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
//	    $kefu7yuyuemonth = $kefu7->where('kefuid', $kefu7id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
//	    $kefu7yuyue = $kefu7->where('kefuid', $kefu7id )->where('yuyue', '1')->count();//总预约
//	    $kefu7daozhentoday = $kefu7->where('kefuid', $kefu7id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
//	    $kefu7daozhenyesterday = $kefu7->where('kefuid', $kefu7id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
//	    $kefu7daozhenmonth = $kefu7->where('kefuid', $kefu7id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
//	    $kefu7daozhen = $kefu7->where('kefuid', $kefu7id )->where('daozhen', '1')->count();//总到诊
//	    $this->assign([
//		    'kefu7dengjitoday' => $kefu7dengjitoday,
//		    'kefu7dengjiyesterday' => $kefu7dengjiyesterday,
//		    'kefu7dengjimonth' => $kefu7dengjimonth,
//		    'kefu7dengji' => $kefu7dengji,
//		    'kefu7yuyuetoday' => $kefu7yuyuetoday,
//		    'kefu7yuyueyesterday' => $kefu7yuyueyesterday,
//		    'kefu7yuyuemonth' => $kefu7yuyuemonth,
//		    'kefu7yuyue' => $kefu7yuyue,
//		    'kefu7daozhentoday' => $kefu7daozhentoday,
//		    'kefu7daozhenyesterday' => $kefu7daozhenyesterday,
//		    'kefu7daozhenmonth' => $kefu7daozhenmonth,
//		    'kefu7daozhen' => $kefu7daozhen,
//	    ]);
//
//
//	    //客服8  id8  鄢爱娥
//	    $kefu8 = \think\Db::name('order')->where('del', '0');
//	    $kefu8dengjitoday = $kefu8->where('kefuid', $kefu8id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
//	    $kefu8dengjiyesterday = $kefu8->where('kefuid', $kefu8id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
//	    $kefu8dengjimonth = $kefu8->where('kefuid', $kefu8id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
//	    $kefu8dengji = $kefu8->where('kefuid', $kefu8id )->count();//总登记
//	    $kefu8yuyuetoday = $kefu8->where('kefuid', $kefu8id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
//	    $kefu8yuyueyesterday = $kefu8->where('kefuid', $kefu8id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
//	    $kefu8yuyuemonth = $kefu8->where('kefuid', $kefu8id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
//	    $kefu8yuyue = $kefu8->where('kefuid', $kefu8id )->where('yuyue', '1')->count();//总预约
//	    $kefu8daozhentoday = $kefu8->where('kefuid', $kefu8id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
//	    $kefu8daozhenyesterday = $kefu8->where('kefuid', $kefu8id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
//	    $kefu8daozhenmonth = $kefu8->where('kefuid', $kefu8id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
//	    $kefu8daozhen = $kefu8->where('kefuid', $kefu8id )->where('daozhen', '1')->count();//总到诊
//	    $this->assign([
//		    'kefu8dengjitoday' => $kefu8dengjitoday,
//		    'kefu8dengjiyesterday' => $kefu8dengjiyesterday,
//		    'kefu8dengjimonth' => $kefu8dengjimonth,
//		    'kefu8dengji' => $kefu8dengji,
//		    'kefu8yuyuetoday' => $kefu8yuyuetoday,
//		    'kefu8yuyueyesterday' => $kefu8yuyueyesterday,
//		    'kefu8yuyuemonth' => $kefu8yuyuemonth,
//		    'kefu8yuyue' => $kefu8yuyue,
//		    'kefu8daozhentoday' => $kefu8daozhentoday,
//		    'kefu8daozhenyesterday' => $kefu8daozhenyesterday,
//		    'kefu8daozhenmonth' => $kefu8daozhenmonth,
//		    'kefu8daozhen' => $kefu8daozhen,
//	    ]);
//
//	    //客服10  id10  徐雪艳
//	    $kefu10 = \think\Db::name('order')->where('del', '0');
//	    $kefu10dengjitoday = $kefu10->where('kefuid', $kefu10id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
//	    $kefu10dengjiyesterday = $kefu10->where('kefuid', $kefu10id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
//	    $kefu10dengjimonth = $kefu10->where('kefuid', $kefu10id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
//	    $kefu10dengji = $kefu10->where('kefuid', $kefu10id )->count();//总登记
//	    $kefu10yuyuetoday = $kefu10->where('kefuid', $kefu10id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
//	    $kefu10yuyueyesterday = $kefu10->where('kefuid', $kefu10id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
//	    $kefu10yuyuemonth = $kefu10->where('kefuid', $kefu10id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
//	    $kefu10yuyue = $kefu10->where('kefuid', $kefu10id )->where('yuyue', '1')->count();//总预约
//	    $kefu10daozhentoday = $kefu10->where('kefuid', $kefu10id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
//	    $kefu10daozhenyesterday = $kefu10->where('kefuid', $kefu10id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
//	    $kefu10daozhenmonth = $kefu10->where('kefuid', $kefu10id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
//	    $kefu10daozhen = $kefu10->where('kefuid', $kefu10id )->where('daozhen', '1')->count();//总到诊
//	    $this->assign([
//		    'kefu10dengjitoday' => $kefu10dengjitoday,
//		    'kefu10dengjiyesterday' => $kefu10dengjiyesterday,
//		    'kefu10dengjimonth' => $kefu10dengjimonth,
//		    'kefu10dengji' => $kefu10dengji,
//		    'kefu10yuyuetoday' => $kefu10yuyuetoday,
//		    'kefu10yuyueyesterday' => $kefu10yuyueyesterday,
//		    'kefu10yuyuemonth' => $kefu10yuyuemonth,
//		    'kefu10yuyue' => $kefu10yuyue,
//		    'kefu10daozhentoday' => $kefu10daozhentoday,
//		    'kefu10daozhenyesterday' => $kefu10daozhenyesterday,
//		    'kefu10daozhenmonth' => $kefu10daozhenmonth,
//		    'kefu10daozhen' => $kefu10daozhen,
//	    ]);
//
//	    //客服11  id11  王欢
//	    $kefu11 = \think\Db::name('order')->where('del', '0');
//	    $kefu11dengjitoday = $kefu11->where('kefuid', $kefu11id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
//	    $kefu11dengjiyesterday = $kefu11->where('kefuid', $kefu11id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
//	    $kefu11dengjimonth = $kefu11->where('kefuid', $kefu11id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
//	    $kefu11dengji = $kefu11->where('kefuid', $kefu11id )->count();//总登记
//	    $kefu11yuyuetoday = $kefu11->where('kefuid', $kefu11id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
//	    $kefu11yuyueyesterday = $kefu11->where('kefuid', $kefu11id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
//	    $kefu11yuyuemonth = $kefu11->where('kefuid', $kefu11id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
//	    $kefu11yuyue = $kefu11->where('kefuid', $kefu11id )->where('yuyue', '1')->count();//总预约
//	    $kefu11daozhentoday = $kefu11->where('kefuid', $kefu11id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
//	    $kefu11daozhenyesterday = $kefu11->where('kefuid', $kefu11id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
//	    $kefu11daozhenmonth = $kefu11->where('kefuid', $kefu11id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
//	    $kefu11daozhen = $kefu11->where('kefuid', $kefu11id )->where('daozhen', '1')->count();//总到诊
//	    $this->assign([
//		    'kefu11dengjitoday' => $kefu11dengjitoday,
//		    'kefu11dengjiyesterday' => $kefu11dengjiyesterday,
//		    'kefu11dengjimonth' => $kefu11dengjimonth,
//		    'kefu11dengji' => $kefu11dengji,
//		    'kefu11yuyuetoday' => $kefu11yuyuetoday,
//		    'kefu11yuyueyesterday' => $kefu11yuyueyesterday,
//		    'kefu11yuyuemonth' => $kefu11yuyuemonth,
//		    'kefu11yuyue' => $kefu11yuyue,
//		    'kefu11daozhentoday' => $kefu11daozhentoday,
//		    'kefu11daozhenyesterday' => $kefu11daozhenyesterday,
//		    'kefu11daozhenmonth' => $kefu11daozhenmonth,
//		    'kefu11daozhen' => $kefu11daozhen,
//	    ]);
//
//	    //客服12  id12  董俊
//	    $kefu12 = \think\Db::name('order')->where('del', '0');
//	    $kefu12dengjitoday = $kefu12->where('kefuid', $kefu12id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
//	    $kefu12dengjiyesterday = $kefu12->where('kefuid', $kefu12id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
//	    $kefu12dengjimonth = $kefu12->where('kefuid', $kefu12id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
//	    $kefu12dengji = $kefu12->where('kefuid', $kefu12id )->count();//总登记
//	    $kefu12yuyuetoday = $kefu12->where('kefuid', $kefu12id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
//	    $kefu12yuyueyesterday = $kefu12->where('kefuid', $kefu12id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
//	    $kefu12yuyuemonth = $kefu12->where('kefuid', $kefu12id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
//	    $kefu12yuyue = $kefu12->where('kefuid', $kefu12id )->where('yuyue', '1')->count();//总预约
//	    $kefu12daozhentoday = $kefu12->where('kefuid', $kefu12id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
//	    $kefu12daozhenyesterday = $kefu12->where('kefuid', $kefu12id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
//	    $kefu12daozhenmonth = $kefu12->where('kefuid', $kefu12id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
//	    $kefu12daozhen = $kefu12->where('kefuid', $kefu12id )->where('daozhen', '1')->count();//总到诊
//	    $this->assign([
//		    'kefu12dengjitoday' => $kefu12dengjitoday,
//		    'kefu12dengjiyesterday' => $kefu12dengjiyesterday,
//		    'kefu12dengjimonth' => $kefu12dengjimonth,
//		    'kefu12dengji' => $kefu12dengji,
//		    'kefu12yuyuetoday' => $kefu12yuyuetoday,
//		    'kefu12yuyueyesterday' => $kefu12yuyueyesterday,
//		    'kefu12yuyuemonth' => $kefu12yuyuemonth,
//		    'kefu12yuyue' => $kefu12yuyue,
//		    'kefu12daozhentoday' => $kefu12daozhentoday,
//		    'kefu12daozhenyesterday' => $kefu12daozhenyesterday,
//		    'kefu12daozhenmonth' => $kefu12daozhenmonth,
//		    'kefu12daozhen' => $kefu12daozhen,
//	    ]);
//
//	    //客服13  id13  王雪芹
//	    $kefu13 = \think\Db::name('order')->where('del', '0');
//	    $kefu13dengjitoday = $kefu13->where('kefuid', $kefu13id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
//	    $kefu13dengjiyesterday = $kefu13->where('kefuid', $kefu13id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
//	    $kefu13dengjimonth = $kefu13->where('kefuid', $kefu13id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
//	    $kefu13dengji = $kefu13->where('kefuid', $kefu13id )->count();//总登记
//	    $kefu13yuyuetoday = $kefu13->where('kefuid', $kefu13id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
//	    $kefu13yuyueyesterday = $kefu13->where('kefuid', $kefu13id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
//	    $kefu13yuyuemonth = $kefu13->where('kefuid', $kefu13id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
//	    $kefu13yuyue = $kefu13->where('kefuid', $kefu13id )->where('yuyue', '1')->count();//总预约
//	    $kefu13daozhentoday = $kefu13->where('kefuid', $kefu13id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
//	    $kefu13daozhenyesterday = $kefu13->where('kefuid', $kefu13id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
//	    $kefu13daozhenmonth = $kefu13->where('kefuid', $kefu13id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
//	    $kefu13daozhen = $kefu13->where('kefuid', $kefu13id )->where('daozhen', '1')->count();//总到诊
//	    $this->assign([
//		    'kefu13dengjitoday' => $kefu13dengjitoday,
//		    'kefu13dengjiyesterday' => $kefu13dengjiyesterday,
//		    'kefu13dengjimonth' => $kefu13dengjimonth,
//		    'kefu13dengji' => $kefu13dengji,
//		    'kefu13yuyuetoday' => $kefu13yuyuetoday,
//		    'kefu13yuyueyesterday' => $kefu13yuyueyesterday,
//		    'kefu13yuyuemonth' => $kefu13yuyuemonth,
//		    'kefu13yuyue' => $kefu13yuyue,
//		    'kefu13daozhentoday' => $kefu13daozhentoday,
//		    'kefu13daozhenyesterday' => $kefu13daozhenyesterday,
//		    'kefu13daozhenmonth' => $kefu13daozhenmonth,
//		    'kefu13daozhen' => $kefu13daozhen,
//	    ]);



	    return $this->fetch();
    }
}
