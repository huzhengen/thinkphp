// document.writeln("<script language=\"javascript\">");
// document.writeln("	var LiveAutoInvite0='���ã�����%IP%������'; ");
// document.writeln("	var LiveAutoInvite1='������ҳ�Զ�����ĶԻ�';");
// document.writeln("	var LiveAutoInvite2='��վ����ͨ��Ҫ���ܣ�<br>1����������<br>2����ʱ��ͨ<br>3���鿴��ʱ���ʶ�̬<br>4�����ʹ켣����<br>5���ڲ��Ի�<br>6������װ�κβ��Ҳʵ��˫���ļ�����<br><br><b>document.writeln(��������κ���������ܴ������Կ�ʼ��ʱ��ͨ</b>';");
// document.writeln("   var LR_next_invite_seconds = 60;");
// document.writeln("</script>");
// document.writeln("<script language=\"javascript\" src=\"http://webservice.zoosnet.net/JS/LsJS.aspx?siteid=LZA45447545&float=1&lng=cn\"></script>");

	
	
	

document.writeln("<script language=javascript>");
document.writeln("<!--");
document.writeln("var LiveAutoInvite0='���ã�����%IP%������';");
document.writeln("var LiveAutoInvite1='������ҳ�ĶԻ�';");
document.writeln("var LiveAutoInvite2='��վ����ͨ ��Ҫ���ܣ�<BR>1����������<BR>2����ʱ��ͨ<BR>3���鿴��ʱ���ʶ�̬<BR>4�����ʹ켣����<BR>5���ڲ��Ի�<BR>6������װ�κβ��Ҳʵ��˫���ļ�����<BR><BR><B>��������κ���������ܴ������Կ�ʼ��ʱ��ͨ</B>';");
document.writeln("var LR_next_invite_seconds = 40;"); //10����ٴ���ʾ�Զ�����
document.writeln("var LrinviteTimeout = 3;");   //3����һ���Զ�����  
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