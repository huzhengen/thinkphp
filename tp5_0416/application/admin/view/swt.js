// document.writeln("<script language=\"javascript\">");
// document.writeln("	var LiveAutoInvite0='您好，来自%IP%的朋友'; ");
// document.writeln("	var LiveAutoInvite1='来自首页自动邀请的对话';");
// document.writeln("	var LiveAutoInvite2='网站商务通主要功能：<br>1、主动邀请<br>2、即时沟通<br>3、查看即时访问动态<br>4、访问轨迹跟踪<br>5、内部对话<br>6、不安装任何插件也实现双向文件传输<br><br><b>document.writeln(如果您有任何问题请接受此邀请以开始即时沟通</b>';");
// document.writeln("   var LR_next_invite_seconds = 60;");
// document.writeln("</script>");
// document.writeln("<script language=\"javascript\" src=\"http://webservice.zoosnet.net/JS/LsJS.aspx?siteid=LZA45447545&float=1&lng=cn\"></script>");

	
	
	

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



document.writeln("<div class=\'rightbot\' style=\'position: fixed;right: 0;bottom: 0;display: none;z-index:50;\'>");
document.writeln("	<a href=\'/swt/\' target=\'_blank\'><img src=\'http://www.atfck.com/images/index/rightbot.png\' alt=\'\'></a>");
document.writeln("	<div class=\'closerightbot\' style=\'width:50px;height:29px;position: absolute;right: 0;top: 0;cursor: pointer;z-index:51;\'></div>");
document.writeln("</div>");
$(function(){
	var time1 = setTimeout(function(){
		$('.rightbot').show();
	}, 5000);
	console.log(1)
	$('.rightbot .closerightbot').click(function(){
		clearTimeout(time1);
		console.log(2)
		$('.rightbot').hide();
		var time2 = setInterval(function(){
			$('.rightbot').show();
		}, 15000)
	})
})