document.writeln("<style>");

	document.writeln("#Diy-foot{");
		document.writeln("position:fixed;");
		document.writeln("left:0;");
		document.writeln("width:100%;");
		document.writeln("bottom:0;");
		document.writeln("z-index:19;");
	document.writeln("}");
	document.writeln("#Diy-foot img{");
		document.writeln("width:100%;");
	document.writeln("}");
	document.writeln("#Diy-foot ul{");
		document.writeln("max-width:640px;");
		document.writeln("margin:0 auto;");
	document.writeln("}");
	document.writeln("#Diy-foot li{");
		document.writeln("width:40%;");
		document.writeln("height:58px;");
		document.writeln("line-height:58px;");
		document.writeln("box-sizing:border-box;");
		document.writeln("float:left;");
		document.writeln("position:relative;");
		document.writeln("background-repeat:no-repeat;");
		document.writeln("background-position:37% center;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(2){");
		document.writeln("background-color:#E13A0C;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(3){");
		document.writeln("background-color:#F68A0E;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(1){");
		document.writeln("width:20%;");
		document.writeln("background-color:#2E3642;");
	document.writeln("}");
	document.writeln("#Diy-foot li em{");
		document.writeln("display:block;");
		document.writeln("float:left;");
		document.writeln("position:absolute;");
		document.writeln("left:50%;");
		document.writeln("margin-left:-45px;");
		document.writeln("margin-top:18px;");
	document.writeln("}");
	document.writeln("#Diy-foot li em img{");
		document.writeln("position:absolute;");
		document.writeln("left:0;");
		document.writeln("top:0;");
		document.writeln("z-index:1;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(2) em{");
		document.writeln("width:27px;");
		document.writeln("height:27px;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(3) em{");
		document.writeln("width:27px;");
		document.writeln("height:24px;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(1) em{");
		document.writeln("width:30px;");
		document.writeln("height:25px;");
		document.writeln("margin-left:-14px;");
		document.writeln("margin-top:8px;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(3) b{");
		document.writeln("position:absolute;");
		document.writeln("top:-4px;");
		document.writeln("left:16px;");
		document.writeln("color:#fff;");
		document.writeln("font-size:12px;");
		document.writeln("border-radius:50%;");
		document.writeln("background:#e60012;");
		document.writeln("width:14px;");
		document.writeln("height:14px;");
		document.writeln("text-align:center;");
		document.writeln("line-height:14px;");
		document.writeln("z-index:2;");
		document.writeln("box-shadow: 0 0 3px rgba(0,0,0,0.8);");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(1) span{");
		document.writeln("font-size:12px;");
		document.writeln("text-align:center;");
		document.writeln("color:#6a7380;");
		document.writeln("margin-top:14px;");
		document.writeln("margin-left:-10px;");
	document.writeln("}");
	document.writeln("#Diy-foot li:nth-child(2) span{");
		document.writeln("margin-left:-10px;");
	document.writeln("}");
	document.writeln("#Diy-foot li span{");
		document.writeln("font-size:16px;");
		document.writeln("color:#fff;");
		document.writeln("margin-left:-14px;");
		document.writeln("display:block;");
		document.writeln("position:absolute;");
		document.writeln("left:50%;");
		document.writeln("float:left;");
	document.writeln("}");

document.writeln("</style>");

document.writeln("<script>");
	document.writeln("$(function(){");
			document.writeln("var LaiHui = 1;");
			document.writeln("var callPhone = $('.callPhone');");
			document.writeln("var freeAsk = $('.freeAsk');");
			document.writeln("setInterval(function(){");
				document.writeln("if(LaiHui == 1){");
					document.writeln("callPhone.css('background','#F68A0E');");
					document.writeln("freeAsk.css('background','#E13A0C');");
					document.writeln("LaiHui = 2;");
				document.writeln("}else if(LaiHui == 2){");
					
					document.writeln("freeAsk.css('background','#F68A0E');");
					document.writeln("callPhone.css('background','#E13A0C');");
					document.writeln("LaiHui = 1;");
				document.writeln("}");
			document.writeln("},1000);");
			
	document.writeln("});");
	
document.writeln("</script>");



document.writeln("<div id=\"Diy-foot\">");
		document.writeln("<ul>");
			document.writeln("<li><a href=\"/\" target=\"_blank\"><em><img src=\"/zhuanti/extend/footer/images/footerLink1.png\"></em><span>首页</span></a></li>");
			document.writeln("<li class='callPhone'><a href=\"tel:01067537758\" target=\"_blank\"><em><img src=\"/zhuanti/extend/footer/images/footerLink3.png\"></em><span>拨打电话</span></a></li>");
			document.writeln("<li class='freeAsk'><a href=\"javascript:void(0)\" class='sBtnEvent' title='免费咨询' ><em><b>4</b><img src=\"/zhuanti/extend/footer/images/footerLink2.png\"></em><span>免费咨询</span></a></li>");
		document.writeln("</ul>");

	document.writeln("</div>");






