<?php
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
$allow_origin = array(
	'http://m.atfck.com',
	'http://wap.atfck.com',
	'http://www.atfck.com',
	'http://at.atfck.com',
	'http://atfck.com',
	'http://3g.atfck.com',
	'http://4g.atfck.com',
	'http://5g.atfck.com',
	'http://6g.atfck.com',
	'http://m.bjatfc.com',
	'http://4g.bjatfc.com',
	'http://wap.bjatfc.com',
	'http://www.bjatfc.com',
	'http://at.bjatfc.com',
	'http://bjatfc.com',
	'http://at.3kkq.com',
	'http://www.3kkq.com',
	'http://3g.3kkq.com',
	'http://4g.3kkq.com',
	'http://m.3kkq.com',
	'http://3kkq.com',
	'http://chenfenglin.com',
	'http://www.chenfenglin.com',
	'http://4g.chenfenglin.com',
	'http://at.chenfenglin.com',
	'http://m.chenfenglin.com',
	'http://www.xjat.com',
	'http://xjat.com',
	'http://www.ycnfck.com',
	'http://ycnfck.com',
	'http://at.ycnfck.com',
);
if(in_array($origin, $allow_origin)){  
    header('Access-Control-Allow-Origin:'.$origin);       
} 
//header("Access-Control-Allow-Origin:*"); //跨域权限设置，允许所有
header('Content-type:text/html;charset=utf-8');
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
$timeprev2min = date("Y-m-d H:i:s", time()-120);
$timeprev5min = date("Y-m-d H:i:s", time()-300);
$timeprev1 = strtotime(date("Y-m-d H:i:s", time()-3600*2));
$timenow = strtotime($time);
$timenoh = date("Y-m-d", time());
$timenohlike = '%' . $timenoh . '%';

//关于IP
// $ip = '115.239.211.112';
//免费的
//$iadd = @file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$ip);
//$iadd = (array)json_decode($iadd);
//if(array_key_exists('province', $iadd)){
//	$ipadd = $ip. '-' . $iadd['province'].'-'.$iadd['city'];
//}else{
//	$ipadd = $ip;
//}
//聚合
//配置您申请的appkey
//$ip = '115.36.36.95';
$appkey = "6b598da1848a4d78828fd5dc8018e50d";
//************1.根据IP/域名查询地址************
$juheshujuurl = "http://apis.juhe.cn/ip/ip2addr";
$params = array(
	"ip" => $ip,//需要查询的IP地址或域名
	"key" => $appkey,//应用APPKEY(应用详细页查询)
	"dtype" => "",//返回数据的格式,xml或json，默认json
);
$paramstring = http_build_query($params);
$content = juhecurl($juheshujuurl,$paramstring);
$result = json_decode($content,true);
if($result){
	if($result['error_code']=='0'){
		$ipadd = $ip. '-' . $result['result']['area'] . '-' . $result['result']['location'];
//		print_r($ipadd);
	}else{
		echo $result['error_code'].":".$result['reason'];
	}
}else{
	echo "请求失败";
}

//关于手机归属地
//免费
$s = file_get_contents('https://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=' . $phone);
$s = iconv("gb2312", "utf-8//IGNORE",$s); 
preg_match_all("/(\w+):'([^']+)/", $s, $m);
$a = array_combine($m[1], $m[2]);
if(array_key_exists('carrier', $a)){
	$padd = $a['carrier'];
}else{
	$padd = '识别失败';
}

if($phone){
	$conn = mysql_connect('localhost','root','dsjfjoejhksA#^%@^#(*#dsf');
	mysql_select_db('php4');
	mysql_query("set names utf8"); //**设置字符集***

	$sql4 = "SELECT * FROM tp5_0416_atfck WHERE black='1'";
	$result4 = mysql_query($sql4)  or die(mysql_error());
	while($resultrow4 = mysql_fetch_row($result4)){
		//电话在黑名单里面
		if($resultrow4[1] == $phone){
			$sql42 = "SELECT COUNT(`ip`) FROM tp5_0416_atfck WHERE ip='$ip' AND dianhua='$phone' AND tjtime < '$time' AND tjtime > '$timeprev'";
			$result42 = mysql_query($sql42)  or die(mysql_error());
			$result42=mysql_fetch_row($result42);
			$sql43 = "SELECT COUNT(`dianhua`) FROM tp5_0416_atfck WHERE dianhua='$phone' AND tjtime like '$timenohlike'";
			$result43 = mysql_query($sql43)  or die(mysql_error());
			$result43=mysql_fetch_row($result43);
			if($result42[0]>=3){
				echo "您的电话已成功提交过，我们将尽快与您联系t。";
			}else{
				if($result43[0]>=3){
					echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可t。';
				}else{
					$sql41 = "INSERT INTO tp5_0416_atfck (name,dianhua,shijian,miaoshu,padd,ip,tjtime,url,shebei,ipadd,black) VALUES ('".$name."', '".$phone."', '".$jztime."', '".$desc."', '".$padd."', '".$ip."', '".$time."', '".$url."', '".$device."', '".$ipadd."', 1)";
					$status41 = mysql_query($sql41);
					if($status41){
						echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可t。';
					}else{
						echo '您的电话提交失败，请您稍后提交，或直接拨打电话010-67537758。';
					}
				}
			}
			return;
		}
		//IP在黑名单里面
		if($resultrow4[6] == $ip){
			$sql42 = "SELECT COUNT(`ip`) FROM tp5_0416_atfck WHERE ip='$ip' AND tjtime < '$time' AND tjtime > '$timeprev'";
			$result42 = mysql_query($sql42)  or die(mysql_error());
			$result42=mysql_fetch_row($result42);
			$sql43 = "SELECT COUNT(`dianhua`) FROM tp5_0416_atfck WHERE dianhua='$phone' AND tjtime like '$timenohlike'";
			$result43 = mysql_query($sql43)  or die(mysql_error());
			$result43=mysql_fetch_row($result43);
			if($result42[0]>=3){
				echo "您的电话已成功提交过，我们将尽快与您联系i。";
			}else{
				if($result43[0]>=3){
					echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可i。';
				}else{
					$sql41 = "INSERT INTO tp5_0416_atfck (name,dianhua,shijian,miaoshu,padd,ip,tjtime,url,shebei,ipadd,black) VALUES ('".$name."', '".$phone."', '".$jztime."', '".$desc."', '".$padd."', '".$ip."', '".$time."', '".$url."', '".$device."', '".$ipadd."', 1)";
					$status41 = mysql_query($sql41);
					if($status41){
						echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可i。';
					}else{
						echo '您的电话提交失败，请您稍后提交，或直接拨打电话010-67537758。';
					}
				}
			}
			return;
		}
		//URL在黑名单里面
		if($resultrow4[8] == $ip){
			$sql42 = "SELECT COUNT(`ip`) FROM tp5_0416_atfck WHERE ip='$ip' AND url='$url' AND tjtime < '$time' AND tjtime > '$timeprev'";
			$result42 = mysql_query($sql42)  or die(mysql_error());
			$result42=mysql_fetch_row($result42);
			$sql43 = "SELECT COUNT(`dianhua`) FROM tp5_0416_atfck WHERE dianhua='$phone' AND tjtime like '$timenohlike'";
			$result43 = mysql_query($sql43)  or die(mysql_error());
			$result43=mysql_fetch_row($result43);
			if($result42[0]>=3){
				echo "您的电话已成功提交过，我们将尽快与您联系u。";
			}else{
				if($result43[0]>=3){
					echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可u。';
				}else{
					$sql41 = "INSERT INTO tp5_0416_atfck (name,dianhua,shijian,miaoshu,padd,ip,tjtime,url,shebei,ipadd,black) VALUES ('".$name."', '".$phone."', '".$jztime."', '".$desc."', '".$padd."', '".$ip."', '".$time."', '".$url."', '".$device."', '".$ipadd."', 1)";
					$status41 = mysql_query($sql41);
					if($status41){
						echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可u。';
					}else{
						echo '您的电话提交失败，请您稍后提交，或直接拨打电话010-67537758。';
					}
				}
			}
			return;
		}
	}

	/*
	 * mysql_fetch_row — 从结果集中取得一行作为枚举数组
	 * 一、同一个IP，2个小时之内留3个电话之后不能提交了
	 * 二、同一个电话，一天之内只能提交3次
	 * */
	$sql2 = "SELECT COUNT(`ip`) FROM tp5_0416_atfck WHERE ip='$ip' AND tjtime < '$time' AND tjtime > '$timeprev'";
	$result2 = mysql_query($sql2)  or die(mysql_error());
	$result2=mysql_fetch_row($result2);
	$sql3 = "SELECT COUNT(`dianhua`) FROM tp5_0416_atfck WHERE dianhua='$phone' AND tjtime like '$timenohlike'";
	$result3 = mysql_query($sql3)  or die(mysql_error());
	$result3=mysql_fetch_row($result3);
	$sql5 = "SELECT COUNT(`dianhua`) FROM tp5_0416_atfck WHERE dianhua='$phone' AND tjtime < '$time' AND tjtime > '$timeprev5min'";
	$result5 = mysql_query($sql5)  or die(mysql_error());
	$result5=mysql_fetch_row($result5);
	if($result2[0]>=3){
		echo "您的电话已成功提交过，我们将尽快与您联系。";
	}else{
		if($result5[0]>=1){
			echo "您的电话已成功提交过，我们将尽快与您联系。";
		}else{
			if($result3[0]>=3){
				echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可。';
			}else{
				$sql1 = "INSERT INTO tp5_0416_atfck (name,dianhua,shijian,miaoshu,padd,ip,tjtime,url,shebei,ipadd) VALUES ('".$name."', '".$phone."', '".$jztime."', '".$desc."', '".$padd."', '".$ip."', '".$time."', '".$url."', '".$device."', '".$ipadd."')";
				$status1 = mysql_query($sql1);
				if($status1){
					echo '您的电话已成功提交，我们将尽快与您联系，稍后您免费接听即可。';
				}else{
					echo '您的电话提交失败，请您稍后提交，或直接拨打电话010-67537758';
				}
			}
		}
	}
}else{
	echo 'error';
}



function check_input($input){
	$input = trim($input);//去除空格
	$input = stripslashes($input);//stripslashes()函数去除用户输入数据中的反斜杠 (\)
	$input = htmlspecialchars($input);//htmlspecialchars() 函数会将用户输入的html和js脚本进行转码
	return $input;
}

/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params=false,$ispost=0){
	$httpInfo = array();
	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
	curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
	curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	if( $ispost )
	{
		curl_setopt( $ch , CURLOPT_POST , true );
		curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
		curl_setopt( $ch , CURLOPT_URL , $url );
	}
	else
	{
		if($params){
			curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
		}else{
			curl_setopt( $ch , CURLOPT_URL , $url);
		}
	}
	$response = curl_exec( $ch );
	if ($response === FALSE) {
		//echo "cURL Error: " . curl_error($ch);
		return false;
	}
	$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
	$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
	curl_close( $ch );
	return $response;
}