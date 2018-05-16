<?php
use think\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 10:00
 */

$name = $_POST['name'];
$tel = $_POST['tel'];
$time = $_POST['time'];
$desc = $_POST['desc'];

//echo $name;

$con = new mysqli('localhost', 'root', 'root');
if($con->connect_error){
	die("连接失败: " . $con->connect_error);
}
mysqli_select_db($con, 'php');
var_dump($con);

$sql = "INSERT INTO tp5_0416_atfckform (name,dianhua,shijian,miaoshu) VALUES ('".$name."', '".$tel."', '".$time."', '".$desc."')";
//$sql = "INSERT INTO tp5_0416_atfckform (name,dianhua,time,miaoshu) VALUES ('3','2','2','2')";

if ($con->query($sql) === TRUE){
	echo 1;
}else{
	echo "Error: " . $sql . "<br>" . $con->error;
}