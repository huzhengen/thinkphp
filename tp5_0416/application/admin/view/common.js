$('.navbar').click(function(){
	getCase();
	openMenu();
})	
$('.close').click(function(){
	$('html').css({
		'overflow-y': 'auto',
		'height': 'auto'
	});
	$('.menu').animate({
		'left': '-51%'
	})
})
$('#taocan').click(function(){
	openMenu();
	getData(17,5);
})
getCase();
function getCase(){
	$.get('/extend/data/diseasedata.html', function(data1) {
		$('.disease').html(data1);
		clickD();
	});
}
function clickD(){
	$('.xiangmu>ul>li').click(function(){
		var dataId = $(this).attr('data-id');
		var caseId = $(this).parent().attr('case-id');
		if(dataId == 18){
			var href = window.location.href;
			getCase();
			openZoosUrl('chatwin', '&e=' + href + ' - ' + escape('项目大全-其它项目'));
		}else if(dataId == 19){
			getCase();
		}
		else{
			getData(dataId,caseId);
		}
	})
}
function getData(dataId,caseId){
	$.get('/extend/data/diseasedata.html', function(data1) {
		$('.disease').html(data1);
		$.get('/extend/data/case'+caseId+'data.html', function(data2) {
			$.get('/extend/data/case'+caseId+'js'+dataId+'.html', function(data3) {
				$('.xiangmu'+caseId).html(data2+data3);
				clickD();
				appendSpan();
			})
		});	
	});
}
function openMenu(){		
	$('html').css({
		'overflow-y': 'hidden',
		'height': '100%'
	});
	$('.menu').animate({
		'left': '50%'
	})
	document.getElementsByClassName("menu")[0].addEventListener('touchmove', function(e){e.preventDefault();}, false);
}
function appendSpan(){
	var str = '<span class="swiper-pagination-bullet" id="other" data-id="18"></span><span class="swiper-pagination-bullet" id="blank" data-id="19"></span>';
	$('.disease5 .swiper-pagination').append(str);
	$('#other').click(function(){
		var href = window.location.href;
		getCase();
		openZoosUrl('chatwin', '&e=' + href + ' - ' + escape('项目大全-其它项目'));
	})
	$('#blank').click(function(){
		getCase();
	})
}
//文章页面
;(function(){
	$('.arccontent p img').removeAttr('style');    
	var arcContentAs = $('.arccontent a');
	arcContentAs.each(function(index, value){
		if($(this).attr('href') == 'javascript:;'){
	    	$(this).addClass('articleOpenZoosUrl');
	    }
	})
    $('.articleOpenZoosUrl').click(function(){
    	var title = document.title.split('_')[0];
    	var href = window.location.href;
    	// console.log('&e=' + href + ' - ' + escape(title));
        openZoosUrl('chatwin', '&e=' + href + ' - ' + escape(title));
    })
})()

//提交表单
$.Tipmsg.r=null;
var showmsg=function(msg){//假定你的信息提示方法为showmsg， 在方法里可以接收参数msg，当然也可以接收到o及cssctl;
	alert(msg);
}
$('#guahao button').click(function(){
	var nowDate = new Date();
	var timeStr = nowDate.getFullYear()+"-"+(nowDate.getMonth() + 1)+"-"+nowDate.getDate()+" "+nowDate.getHours()+":"+nowDate.getMinutes()+":"+nowDate.getSeconds();
	document.getElementById("tjsj").value=timeStr;
})
// $("#guahao").Validform({
// 	tiptype:function(msg){
// 		showmsg(msg);
// 	},
// 	tipSweep:true,
// 	ajaxPost:false
// });
$("form").on("submit",function(event){
    event.preventDefault();
　　//return false;  当然这里也可以返回false。
})
// $('.tel').blur(function(){
//     var tel = $('.tel').val();
//     checkName(name);
//     checkTel(tel);
// })
$('#tijiao').click(function(){
    var name = $("input[name='name']").val();
    var tel  = $("input[name='tel']").val();
    var jztime = $("input[name='time']").val();
    var desc = $('#desc').val();
    console.log(name,tel,jztime,desc);
    if(!checkName(name)){
        return;
    }
    if(!checkTel(tel)){
        console.log('检查是错误的号码');
        return;
    }
    if(!checkTime(jztime)){
        return;
    }
    if(!checkDesc(desc)){
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
	$('#tijiao').html('正在提交......');
    $.ajax({
        type: 'post',
        url: 'http://data.atfck.com/yygh.php',
        data: {'name':name,'tel':tel,'jztime':jztime,'desc':desc,'device':device,'url':url,'device':device},
        success:function(data){
            console.log(data)
            // console.log(JSON.parse(data));
            // console.log(JSON.parse(data).name)
            alert(data);
            $('#tijiao').html('提交信息');
        },
        error:function(XHR, textStatus, errorThrown){
            console.log('error: ' + textStatus);
            console.log('error: ' + errorThrown);
        }
    });
});

function checkTel(inputVal) {
    var subStr = inputVal.substr(0,1);
    if(subStr != ''){
    	if(subStr == '0'){
	        var telreg = /^0\d{2,3}(\d{8,9})$/;			//固话
	        if(!telreg.test(inputVal)){
	            alert('固话格式错误,请重新填写!');
	            console.log(123)
	            $('#error-msg').html('<span>固话格式错误,请重新填写!</span>');
	            return false;
	            console.log('固话出错了，还跳')
	        }else{
	            return true;
	        }
	    }else{
	        var phonereg = /^1[345678]\d{9}$/;				//手机
	        if(!phonereg.test(inputVal)){
	            alert('手机号码格式错误,请重新填写!');
	            console.log(1234)
	            $('#error-msg').html('<span>手机号码格式错误,请重新填写!</span>');
	            return false;
	            console.log('手机出错了，还跳')
	        }else{
	            return true;
	        }
	    }
    }else{
    	alert('请输入电话号码');
    	return false;
    }
    
}
function checkName(inputVal) {
	var name = inputVal;
	if(name != ''){
		return true;
	}else{
		alert('请输入姓名');
		return false;
	}
}
function checkTime(inputVal) {
	var time = inputVal;
	if(time != ''){
		return true;
	}else{
		alert('请输入预约时间');
		return false;
	}
}
function checkDesc(inputVal) {
	var desc = inputVal;
	if(desc != ''){
		return true;
	}else{
		alert('请阐述您的病情');
		return false;
	}
}
//diy-bot
document.writeln("<div id=\'diy-bot\'>");
document.writeln("	<div class=\'diy-box\'>");
document.writeln("		<h2>安太妇产咨询中心<div class=\'diy-close\'>X</div></h2>");
document.writeln("		<div class=\'diy-cont\'>");
document.writeln("			<dl>");
document.writeln("				<dt><img src=\'/extend/images/ysh.jpg\'></dt>");
// document.writeln("				<dd><p>您好，我是安太妇产医院在线医生，提供<br>免费咨询服务，您有什么问题吗？</p></dd>");
document.writeln("				<dd><p>您好，有什么问题请讲？在线咨询即时为您<br>解答！</p></dd>");
document.writeln("			</dl>");
document.writeln("		</div>");
document.writeln("		<div class=\'diy-click\'>");
document.writeln("			<span><a href=\'javascript:;\' class=\'openZixun\' data-zx=\'底部弹窗\'></a></span>");
document.writeln("			<div><a href=\'javascript:;\'class=\'openZixun\' data-zx=\'底部弹窗\' title=\'请输入您的问题......\'>请输入您的问题......</a></div>");
document.writeln("			<a href=\'tel:01067537758\' >拨打电话</a>");
document.writeln("		</div>");
document.writeln("	</div>");
document.writeln("</div>");
(function(){
	var Dclose = $('.diy-close');
	var Dbot = $('#diy-bot');
	var timeId = null;
	Dclose.click(function(){
		Dbot.slideUp();
		timeId = setTimeout(showBox,15000);	
	});
	function showBox(){
		Dbot.slideDown();
	}
	timeId = setTimeout(showBox,1000);
})()
;(function(){
	$('.openZixun').click(function(){
		var dataZX = $(this).attr('data-zx');
		var href = window.location.href;
    	// console.log('&e=' + href + ' - ' + escape(dataZX));
        openZoosUrl('chatwin', '&e=' + href + ' - ' + escape(dataZX));
    })
})()

// $('input').focus(function() {
// 	$(".footbot").css({"position":"static","display":"none"});
// });
// $('input').blur(function() {
// 	$(".footbot").css({"position":"fixed","display":"block"});
// });

// document.writeln("<a href=\'javascript:;\' class=\'youhui openZixun\' data-zx=\'左侧-优惠图片\'></a>");
document.writeln("<a href=\'/a/news/264.html\' class=\'youhui\' data-zx=\'左侧-优惠图片\'></a>");

document.writeln("<script language=javascript>");
document.writeln("<!--");
document.writeln("var LiveAutoInvite0='您好，来自%IP%的朋友';");
document.writeln("var LiveAutoInvite1='来自首页的对话';");
document.writeln("var LiveAutoInvite2='网站商务通 主要功能：<BR>1、主动邀请<BR>2、即时沟通<BR>3、查看即时访问动态<BR>4、访问轨迹跟踪<BR>5、内部对话<BR>6、不安装任何插件也实现双向文件传输<BR><BR><B>如果您有任何问题请接受此邀请以开始即时沟通</B>';");
document.writeln("var LR_next_invite_seconds = 40;"); //10秒后再次显示自动邀请
document.writeln("var LrinviteTimeout = 3;");   //3秒后第一次自动弹出  
document.writeln("//-->");
document.writeln("</script>");
document.writeln("<script language=\"javascript\" src=\"http://webservice.zoosnet.net/JS/LsJS.aspx?siteid=LZA45447545&float=1&lng=cn\"></script>");

//lxb
//m.atfck.com
;(function(){
	var _hmt = _hmt || []; (function() { var hm = document.createElement("script"); 
	hm.src = "https://hm.baidu.com/hm.js?e5578fb03d2eecc797aab1e0f2672433"; 
	var s = document.getElementsByTagName("script")[0]; 
	s.parentNode.insertBefore(hm, s); })();
})()
//m.bjatfc.com
;(function(){
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "https://hm.baidu.com/hm.js?caef6cf71d2c170b008a16fe7032220e";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
})();

document.writeln("<script type=\'text/javascript\' charset=\'utf-8\' async src=\'http://lxbjs.baidu.com/lxb.js?sid=12088618\'></script>");
document.writeln("<script type=\'text/javascript\' charset=\'utf-8\' async src=\'http://lxbjs.baidu.com/lxb.js?sid=12127788\'></script>");
