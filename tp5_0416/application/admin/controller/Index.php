<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Index extends Basic
{
    public function index()
    {
    	$id = session('id');
	    $kefu1id = '3';
	    $kefu2id = '4';
	    $kefu1name = \think\Db::name('admin')->where('id', $kefu1id)->field('name')->find();
	    $kefu2name = \think\Db::name('admin')->where('id', $kefu2id)->field('name')->find();
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
		    'kefu1name' => $kefu1name,
		    'kefu2name' => $kefu2name,
	    ]);



	    //myself个人的
	    $myselfdengjitoday = $allusers->where('kefuid', $id)->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
	    $myselfdengjiyesterday = $allusers->where('kefuid', $id)->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
	    $myselfdengjimonth = $allusers->where('kefuid', $id)->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
	    $myselfdengji = $allusers->where('kefuid', $id)->count();//总登记
	    $myselfyuyuetoday = $allusers->where('kefuid', $id)->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
	    $myselfyuyueyesterday = $allusers->where('kefuid', $id)->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
	    $myselfyuyuemonth = $allusers->where('kefuid', $id)->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
	    $myselfyuyue = $allusers->where('kefuid', $id)->where('yuyue', '1')->count();//总预约
	    $myselfdaozhentoday = $allusers->where('kefuid', $id)->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
	    $myselfdaozhenyesterday = $allusers->where('kefuid', $id)->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
	    $myselfdaozhenmonth = $allusers->where('kefuid', $id)->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
	    $myselfdaozhen = $allusers->where('kefuid', $id)->where('daozhen', '1')->count();//总到诊
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
	    $allusersdengjitoday = $allusers->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
	    $allusersdengjiyesterday = $allusers->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
	    $allusersdengjimonth = $allusers->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
	    $allusersdengji = $allusers->count();//总登记
	    $allusersyuyuetoday = $allusers->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
	    $allusersyuyueyesterday = $allusers->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
	    $allusersyuyuemonth = $allusers->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
	    $allusersyuyue = $allusers->where('yuyue', '1')->count();//总预约
	    $allusersdaozhentoday = $allusers->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
	    $allusersdaozhenyesterday = $allusers->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
	    $allusersdaozhenmonth = $allusers->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
	    $allusersdaozhen = $allusers->where('daozhen', '1')->count();//总到诊
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
	    $kefu1czmonth = $allusers->where('kefuid', $kefu1id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();
	    $kefu2czmonth = $allusers->where('kefuid', $kefu2id)->where('czfz', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();
	    //复诊/月
	    $kefu1fzmonth = $allusers->where('kefuid', $kefu1id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();
	    $kefu2fzmonth = $allusers->where('kefuid', $kefu2id)->where('czfz', '2')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();
	    //总到诊
	    $kefu1dz = $allusers->where('kefuid', $kefu1id)->where('daozhen', '1')->count();
	    $kefu2dz = $allusers->where('kefuid', $kefu2id)->where('daozhen', '1')->count();
	    //总预约
	    $kefu1yy = $allusers->where('kefuid', $kefu1id)->where('yuyue', '1')->count();
	    $kefu2yy = $allusers->where('kefuid', $kefu2id)->where('yuyue', '1')->count();
	    $this->assign([
		    'kefu1czmonth' => $kefu1czmonth,
		    'kefu2czmonth' => $kefu2czmonth,
		    'kefu1fzmonth' => $kefu1fzmonth,
		    'kefu2fzmonth' => $kefu2fzmonth,
		    'kefu1dz' => $kefu1dz,
		    'kefu2dz' => $kefu2dz,
		    'kefu1yy' => $kefu1yy,
		    'kefu2yy' => $kefu2yy,
	    ]);



	    //客服1 id3
	    $kefu1 = \think\Db::name('order')->where('del', '0');
	    $kefu1dengjitoday = $kefu1->where('kefuid', $kefu1id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
	    $kefu1dengjiyesterday = $kefu1->where('kefuid', $kefu1id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
	    $kefu1dengjimonth = $kefu1->where('kefuid', $kefu1id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
	    $kefu1dengji = $kefu1->where('kefuid', $kefu1id )->count();//总登记
	    $kefu1yuyuetoday = $kefu1->where('kefuid', $kefu1id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
	    $kefu1yuyueyesterday = $kefu1->where('kefuid', $kefu1id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
	    $kefu1yuyuemonth = $kefu1->where('kefuid', $kefu1id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
	    $kefu1yuyue = $kefu1->where('kefuid', $kefu1id )->where('yuyue', '1')->count();//总预约
	    $kefu1daozhentoday = $kefu1->where('kefuid', $kefu1id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
	    $kefu1daozhenyesterday = $kefu1->where('kefuid', $kefu1id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
	    $kefu1daozhenmonth = $kefu1->where('kefuid', $kefu1id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
	    $kefu1daozhen = $kefu1->where('kefuid', $kefu1id )->where('daozhen', '1')->count();//总到诊
	    $this->assign([
		    'kefu1dengjitoday' => $kefu1dengjitoday,
		    'kefu1dengjiyesterday' => $kefu1dengjiyesterday,
		    'kefu1dengjimonth' => $kefu1dengjimonth,
		    'kefu1dengji' => $kefu1dengji,
		    'kefu1yuyuetoday' => $kefu1yuyuetoday,
		    'kefu1yuyueyesterday' => $kefu1yuyueyesterday,
		    'kefu1yuyuemonth' => $kefu1yuyuemonth,
		    'kefu1yuyue' => $kefu1yuyue,
		    'kefu1daozhentoday' => $kefu1daozhentoday,
		    'kefu1daozhenyesterday' => $kefu1daozhenyesterday,
		    'kefu1daozhenmonth' => $kefu1daozhenmonth,
		    'kefu1daozhen' => $kefu1daozhen,
	    ]);


	    //客服2 id4
	    $kefu2 = \think\Db::name('order')->where('del', '0');
	    $kefu2dengjitoday = $kefu2->where('kefuid', $kefu2id )->where('djtime', 'between', [$todaytime, $tomorrowtime])->count();//今日登记
	    $kefu2dengjiyesterday = $kefu2->where('kefuid', $kefu2id )->where('djtime', 'between', [$yesterdaytime, $todaytime])->count();//昨天登记
	    $kefu2dengjimonth = $kefu2->where('kefuid', $kefu2id )->where('djtime', 'between', [$monthtime, $tomorrowtime])->count();//本月登记
	    $kefu2dengji = $kefu2->where('kefuid', $kefu2id )->count();//总登记
	    $kefu2yuyuetoday = $kefu2->where('kefuid', $kefu2id )->where('yuyue', '1')->where('yytime', 'between', [$todaytime, $tomorrowtime])->count();//今日预约
	    $kefu2yuyueyesterday = $kefu2->where('kefuid', $kefu2id )->where('yuyue', '1')->where('yytime', 'between', [$yesterdaytime, $todaytime])->count();//昨日预约
	    $kefu2yuyuemonth = $kefu2->where('kefuid', $kefu2id )->where('yuyue', '1')->where('yytime', 'between', [$monthtime, $tomorrowtime])->count();//本月预约
	    $kefu2yuyue = $kefu2->where('kefuid', $kefu2id )->where('yuyue', '1')->count();//总预约
	    $kefu2daozhentoday = $kefu2->where('kefuid', $kefu2id )->where('daozhen', '1')->where('dztime', 'between', [$todaytime, $tomorrowtime])->count();//今日到诊
	    $kefu2daozhenyesterday = $kefu2->where('kefuid', $kefu2id )->where('daozhen', '1')->where('dztime', 'between', [$yesterdaytime, $todaytime])->count();//昨日到诊
	    $kefu2daozhenmonth = $kefu2->where('kefuid', $kefu2id )->where('daozhen', '1')->where('dztime', 'between', [$monthtime, $tomorrowtime])->count();//本月到诊
	    $kefu2daozhen = $kefu2->where('kefuid', $kefu2id )->where('daozhen', '1')->count();//总到诊
	    $this->assign([
		    'kefu2dengjitoday' => $kefu2dengjitoday,
		    'kefu2dengjiyesterday' => $kefu2dengjiyesterday,
		    'kefu2dengjimonth' => $kefu2dengjimonth,
		    'kefu2dengji' => $kefu2dengji,
		    'kefu2yuyuetoday' => $kefu2yuyuetoday,
		    'kefu2yuyueyesterday' => $kefu2yuyueyesterday,
		    'kefu2yuyuemonth' => $kefu2yuyuemonth,
		    'kefu2yuyue' => $kefu2yuyue,
		    'kefu2daozhentoday' => $kefu2daozhentoday,
		    'kefu2daozhenyesterday' => $kefu2daozhenyesterday,
		    'kefu2daozhenmonth' => $kefu2daozhenmonth,
		    'kefu2daozhen' => $kefu2daozhen,
	    ]);


	    //安太宝留电
	    $antaibao = \think\Db::name('antaibao');
	    $antaibaotoday = $antaibao->where('tjtime', 'between', [$todaytime, $tomorrowtime])->count();
	    $antaibaotodayyes = $antaibao->where('queren', '1')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->count();
	    $antaibaotodayno = $antaibao->where('queren', '0')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->count();
	    $antaibaoyesterday = $antaibao->where('tjtime', 'between', [$yesterdaytime, $todaytime])->count();
	    $antaibaoyesterdayyes = $antaibao->where('queren', '1')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->count();
	    $antaibaoyesterdayno = $antaibao->where('queren', '0')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->count();
	    $antaibaomonth = $antaibao->where('tjtime', 'between', [$monthtime, $tomorrowtime])->count();
	    $antaibaomonthyes = $antaibao->where('queren', '1')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->count();
	    $antaibaomonthno = $antaibao->where('queren', '0')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->count();
	    $antaibaoall = $antaibao->count();
	    $antaibaoallyes = $antaibao->where('queren', '1')->count();
	    $antaibaoallno = $antaibao->where('queren', '0')->count();
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
	    $form = \think\Db::name('atfckform');
	    $formtoday = $form->where('tjtime', 'between', [$todaytime, $tomorrowtime])->count();
	    $formtodayyes = $form->where('queren', '1')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->count();
	    $formtodayno = $form->where('queren', '0')->where('tjtime', 'between', [$todaytime, $tomorrowtime])->count();
	    $formyesterday = $form->where('tjtime', 'between', [$yesterdaytime, $todaytime])->count();
	    $formyesterdayyes = $form->where('queren', '1')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->count();
	    $formyesterdayno = $form->where('queren', '0')->where('tjtime', 'between', [$yesterdaytime, $todaytime])->count();
	    $formmonth = $form->where('tjtime', 'between', [$monthtime, $tomorrowtime])->count();
	    $formmonthyes = $form->where('queren', '1')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->count();
	    $formmonthno = $form->where('queren', '0')->where('tjtime', 'between', [$monthtime, $tomorrowtime])->count();
	    $formall = $form->count();
	    $formallyes = $form->where('queren', '1')->count();
	    $formallno = $form->where('queren', '0')->count();
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



	    return $this->fetch();
    }
}
