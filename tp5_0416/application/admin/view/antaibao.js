document.writeln("<style>");
document.writeln(".clearfix:after {");
document.writeln("	content: \'.\';");
document.writeln("	display: block;");
document.writeln("	height: 0;");
document.writeln("	clear: both;");
document.writeln("	visibility: hidden;");
document.writeln("}");
document.writeln(".atb_left {");
// document.writeln("  width: 2rem;");
document.writeln("  text-align: center;");
document.writeln("  font-size: 0.8rem;");
document.writeln("  color: #fff;");
document.writeln("  position: fixed;");
document.writeln("  left: 0;");
document.writeln("  top: 20%;");
document.writeln("  background-color: #0070c0;");
document.writeln("  border-radius: 0.15625rem;");
document.writeln("  padding: 0.3125rem 0.2rem;");
// document.writeln("  line-height: 0.7rem;");
document.writeln("  cursor: pointer;");
document.writeln("  z-index: 21;");
document.writeln("}");
document.writeln(".atb_container {");
document.writeln("  width: 17.125rem;");
document.writeln("  background-color: #fff;");
document.writeln("  border: 0.0625rem solid #0b7bd2;");
document.writeln("  border-radius: 0.25rem;");
document.writeln("  position: fixed;");
document.writeln("  left: 50%;");
document.writeln("  transform: translatex(-50%);");
document.writeln("  top: 35%;");
document.writeln("  z-index: 21;");
document.writeln("  display: none;");
document.writeln("}");
document.writeln(".atb_hide {");
document.writeln("  width: 1.25rem;");
document.writeln("  height: 1.25rem;");
document.writeln("  line-height: 1rem;");
document.writeln("  text-align: center;");
document.writeln("  background-color: #0070c0;");
document.writeln("  position: absolute;");
document.writeln("  right: -0.625rem;");
document.writeln("  top: -0.625rem;");
document.writeln("  border-radius: 50%;");
document.writeln("  color: #fff;");
document.writeln("  font-size: 1.5625rem;");
document.writeln("  cursor: pointer;");
document.writeln("}");
document.writeln(".atb_top {");
document.writeln("  width: 90%;");
document.writeln("  margin: 0.59375rem auto 0;");
document.writeln("}");
document.writeln(".atb_input {");
document.writeln("  float: left;");
document.writeln("  border: 1px solid #ccc;");
document.writeln("  background-color: #fff;");
document.writeln("  border-radius: 0.09375rem;");
document.writeln("  font-size: 0.7531249999999999rem;");
document.writeln("  width: 10.625rem;");
document.writeln("  height: 0.9375rem;");
document.writeln("  line-height: 0.9375rem;");
document.writeln("  padding: 0.15625rem;");
document.writeln("}");
document.writeln(".atb_input_btn {");
document.writeln("  float: right;");
document.writeln("  background-color: #2590e2;");
document.writeln("  border-radius: 0.25rem;");
document.writeln("  color: #fff;");
document.writeln("  outline: none;");
document.writeln("  border: none;");
document.writeln("  box-sizing: content-box;");
document.writeln("  font-size: 0.7531249999999999rem;");
document.writeln("  padding: 0.15625rem 0.46875rem;");
document.writeln("  cursor: pointer;");
document.writeln("}");
document.writeln(".atb_text {");
document.writeln("  width: 80%;");
document.writeln("  margin: 0.59375rem auto 0.59375rem;");
document.writeln("  font-size: 0.7531249999999999rem;");
document.writeln("  color: #2d85d5;");
document.writeln("}");
document.writeln(".atb_text span {");
document.writeln("  color: red;");
document.writeln("}");
document.writeln(".atb_text b {");
document.writeln("  color: green;");
document.writeln("}");
document.writeln(".submiting {");
document.writeln("  width: 100%;");
document.writeln("  height: 100%;");
document.writeln("  position: absolute;");
document.writeln("  left: 0;");
document.writeln("  top: 0;");
document.writeln("  right: 0;");
document.writeln("  bottom: 0;");
document.writeln("  background: rgba(255, 255, 255, 0.7);");
document.writeln("  text-align: center;");
document.writeln("  display: none;");
document.writeln("}");
document.writeln(".submiting .con {");
document.writeln("  width: 100%;");
document.writeln("  position: absolute;");
document.writeln("  left: 0;");
document.writeln("  top: 0;");
document.writeln("}");
document.writeln(".submiting .con ul li {");
document.writeln("  width: 0.625rem;");
document.writeln("  height: 0.625rem;");
document.writeln("  border-radius: 50%;");
document.writeln("  background-color: #000;");
document.writeln("  animation: bounce 1.4s infinite ease-in-out;");
document.writeln("  -webkit-animation: bounce 1.4s infinite ease-in-out;");
document.writeln("  -moz-animation: bounce 1.4s infinite ease-in-out;");
document.writeln("  -ms-animation: bounce 1.4s infinite ease-in-out;");
document.writeln("  -o-animation: bounce 1.4s infinite ease-in-out;");
document.writeln("  list-style: none;");
document.writeln("  display: inline-block;");
document.writeln("}");
document.writeln(".submiting .con ul p {");
document.writeln("  font-size: 0.7531249999999999rem;");
document.writeln("}");
document.writeln(".submiting .con ul li:nth-of-type(1) {");
document.writeln("  animation-delay: -0.32s;");
document.writeln("  -webkit-animation-delay: -0.32s;");
document.writeln("  -moz-animation-delay: -0.32s;");
document.writeln("  -ms-animation-delay: -0.32s;");
document.writeln("  -o-animation-delay: -0.32s;");
document.writeln("}");
document.writeln(".submiting .con ul li:nth-of-type(2) {");
document.writeln("  animation-delay: -0.16s;");
document.writeln("  -webkit-animation-delay: -0.16s;");
document.writeln("  -moz-animation-delay: -0.16s;");
document.writeln("  -ms-animation-delay: -0.16s;");
document.writeln("  -o-animation-delay: -0.16s;");
document.writeln("}");
document.writeln("@keyframes bounce {");
document.writeln("  0%,");
document.writeln("80%,");
document.writeln("100% {");
document.writeln("  transform: scale(0);");
document.writeln("}");
document.writeln("40% {");
document.writeln("  transform: scale(1);");
document.writeln("}");
document.writeln("}");
document.writeln("@-webkit-keyframes bounce {");
document.writeln("  0%,");
document.writeln("80%,");
document.writeln("100% {");
document.writeln("  transform: scale(0);");
document.writeln("}");
document.writeln("40% {");
document.writeln("  transform: scale(1);");
document.writeln("}");
document.writeln("}");
document.writeln("@-moz-keyframes bounce {");
document.writeln("  0%,");
document.writeln("80%,");
document.writeln("100% {");
document.writeln("  transform: scale(0);");
document.writeln("}");
document.writeln("40% {");
document.writeln("  transform: scale(1);");
document.writeln("}");
document.writeln("}");
document.writeln("@-o-keyframes bounce {");
document.writeln("  0%,");
document.writeln("80%,");
document.writeln("100% {");
document.writeln("  transform: scale(0);");
document.writeln("}");
document.writeln("40% {");
document.writeln("  transform: scale(1);");
document.writeln("}");
document.writeln("}");
document.writeln("</style>");

document.writeln("<div class=\'atb_left\'>免<br>费<br>通<br>话</div>");
document.writeln("<div class=\'atb_container\'>");
document.writeln("	<div class=\'submiting\'>");
document.writeln("		<div class=\'con\'>");
document.writeln("			<ul>");
document.writeln("				<li></li>");
document.writeln("				<li></li>");
document.writeln("				<li></li>");
document.writeln("				<p>正在提交......</p>");
document.writeln("			</ul>");
document.writeln("		</div>");
document.writeln("	</div>");
document.writeln("	<div class=\'atb_hide\'>×</div>");
document.writeln("	<div class=\'atb_top clearfix\'>");
document.writeln("		<input type=\'text\' name=\'phone\' class=\'atb_input\' maxlength=\'12\' placeholder=\'请输入您的电话号码\'>");
document.writeln("		<button class=\'atb_input_btn\' id=\'tijiao\'>给您回电</button>");
document.writeln("	</div>");
document.writeln("	<p class=\'atb_text\'>我们将立即回电。<span>该通话对您免费</span>，请放心接听！手机请直接输入，座机前加区号：如01067537758</p>");
document.writeln("</div>");
var time1 = setTimeout(function(){
	$('.atb_container').show();
	$('.atb_left').hide();
}, 5000)
$('.atb_left').click(function(){
	$(this).hide();
	$('.atb_container').show();
})
$('.atb_hide').click(function(){
	$('.atb_container').hide();
	$('.atb_left').show();
	clearTimeout(time1);
	clearTimeout(time2);
	var time2 = setTimeout(function(){
		$('.atb_container').show();
		$('.atb_left').hide();
	},8000)
})
$('.atb_input').click(function(){
    $('.atb_text').html('我们将立即回电。<span>该通话对您免费</span>，请放心接听！手机请直接输入，座机前加区号：如01067537758');
})
//validate
$('.atb_input').blur(function(){
    var tel = $('.atb_input').val();
    if(tel){
    	check(tel);
    }
})
$('#tijiao').click(function(){
    var tel = $('.atb_input').val();
    if(tel){
    	if(!check(tel)){
            console.log('检查是错误的号码');
			return;
        }
    }else{
    	return;
    }
    var system = {
        win : false,
        mac : false,
        xll : false
    };
    var device = null;
    var zd = null;
    var p = navigator.platform;
    system.win = p.indexOf("Win") == 0;
    system.mac = p.indexOf("Mac") == 0;
    system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
    if(system.win){//转向后台登陆页面
        device = 'windows';
        zd = 'c';
    }else if(system.mac){
        device = 'mac';
    }else if(system.xll){
        device = 'linux或其他';
    }else{
        if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {  	//判断iPhone|iPad|iPod|iOS
            zd = 'i';
            device = '苹果'
        } else if (/(Android)/i.test(navigator.userAgent)) {  	 	//判断Android
            zd = 'a';
            device='安卓';
        } else {
            zd = 'x';
            device = '其它手机'
        };
        // device = 'p';
    }
    var url = window.location.href;
    $('.submiting').show()
    $('.atb_input_btn').html('正在提交');
    $.ajax({
        // async:false,
        type: 'post',
        url: 'http://data.atfck.com/antaibao.php',
        data: {'tel':tel,'device':device,'url':url,'device':device},
        success:function(data){
            console.log(data)
            // console.log(JSON.parse(data));
            // console.log(JSON.parse(data).name)
            // alert(data);
            $('.atb_text').html('<b>'+data+'</b>');
            $('.submiting').hide()
			$('.atb_input_btn').html('给您回电');
        },
        error:function(XHR, textStatus, errorThrown){
            console.log('error: ' + textStatus);
            console.log('error: ' + errorThrown);
        }
    });
});
function check(inputVal) {
    var subStr = inputVal.substr(0,1);
    if(subStr == '0'){
        var tel = /^0\d{2,3}(\d{8,9})$/;		//固话
        if(!tel.test(inputVal)){
            // alert('固话格式错误,请重新填写!');
            // console.log(123)
            $('.atb_text').html('<span>请您输入正确的号码，手机号码请直接输入，座机请加区号。</span>');
            return false;                
        }else{
            return true;
        }
    }else{
        var phone = /^1[345678]\d{9}$/;				//手机
        if(!phone.test(inputVal)){
            // alert('手机号码格式错误,请重新填写!');
            // console.log(1234)
            $('.atb_text').html('<span>请您输入正确的号码，手机号码请直接输入，座机请加区号。</span>');
            return false;
        }else{
            return true;
        }
    }
}