<?php
$origin = 'http://m.atfck.com,http://4g.atfck.com';
header('Access-Control-Allow-Origin:' . $origin);
//header("Access-Control-Allow-Origin:*"); //跨域权限设置，允许所有
header('Content-type:text/html; charset=utf-8');
date_default_timezone_set('PRC');
set_time_limit(0);

$name      = check_input($_POST['name']);
$phone 		= 	check_input($_POST['tel']);
$jztime = check_input($_POST['jztime']);
$desc = check_input($_POST['desc']);
$url = check_input($_POST['url']);
$device = check_input($_POST['device']);
$ip 		= 	$_SERVER['REMOTE_ADDR'];
$time = date("Y-m-d H:i:s", time());
$timeprev = date("Y-m-d H:i:s", time()-3600*2);
$timeprev1 = strtotime(date("Y-m-d H:i:s", time()-3600*2));
$timenow = strtotime($time);
$timenoh = date("Y-m-d", time());
$timenohlike = '%' . $timenoh . '%';

//关于IP
// $ip = '115.239.211.112';
$iadd = @file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$ip);
$iadd = (array)json_decode($iadd);
if(array_key_exists('province', $iadd)){
	$ipadd = $ip. '-' . $iadd['province'].'-'.$iadd['city'];
}else{
	$ipadd = $ip;
}



//关于手机归属地
$s = file_get_contents('http://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=' . $phone);
$s = iconv("gb2312", "utf-8//IGNORE",$s); 
preg_match_all("/(\w+):'([^']+)/", $s, $m);
$a = array_combine($m[1], $m[2]);
//$padd = $a['carrier'];
if(array_key_exists('carrier', $a)){
	$padd = $a['carrier'];
}else{
	$padd = '该手机号没检测出来，固话目前没有检测';
}

$conn = mysql_connect('localhost','php1','dsjfjoejhksA#^%@^#(*#dsf');
mysql_select_db('php');
mysql_query("set names utf8"); //**设置字符集***




$sql2 = "SELECT COUNT(`ip`) FROM `tp5_0416_atfck` WHERE ip='$ip' AND shijian < '$time' AND shijian > '$timeprev'";
$result2 = mysql_query($sql2)  or die(mysql_error());
$result2=mysql_fetch_row($result2);//函数1
if($result2[0]>=3){
	echo "您今天已经提交了".$result2[0]."次，请稍后再试";
}else{
//	echo "您今天已经提交了".$result2[0]."次 - " . $time . ' - ' . $timeprev;
	$sql1 = "INSERT INTO tp5_0416_atfckform (name,dianhua,shijian,miaoshu,padd,ip,tjtime,url,shebei) VALUES ('".$name."', '".$phone."', '".$jztime."', '".$desc."', '".$padd."', '".$ip."', '".$time."', '".$url."', '".$device."')";
	$status1 = mysql_query($sql1);
	if($status1){
		echo '信息提交成功！';
	}else{
		echo '信息提交失败！';
	}
}





//$callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; //jsonp回调参数，必需
//$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);//把预定义的字符转换为 HTML 实体。
//$date = array('name'=>$name, 'phone'=>$phone);
//$tmp= json_encode($date); //json 数据
////echo $callback . '(' . $tmp .')';  //返回格式，必需
//$json_data=json_encode($date);//转换为json数据
////$callback = $_GET['callback'];
////echo $callback.'('.json_encode($date).')';
//echo $json_data;
//exit;
//if (!empty($_GET['callbak'])) {
//	return $_GET['callbak'] . '(' . $json_data . ')'; // jsonp
//}else{
//	return $json_data; // json
//}

function check_input($input){  
    $input = trim($input);//去除空格  
    $input = stripslashes($input);//stripslashes()函数去除用户输入数据中的反斜杠 (\)  
    $input = htmlspecialchars($input);//htmlspecialchars() 函数会将用户输入的html和js脚本进行转码  
    return $input;  
}