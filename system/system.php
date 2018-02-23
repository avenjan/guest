<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<style>

.mainnav_title{ display:none;}
h1 { height:30px;line-height:30px;font-size:14px;padding-left:15px;background:#EEE;border-bottom:1px solid #ddd;border-right:1px solid #ddd;overflow:hidden;zoom:1;margin-bottom:10px;}
h1 b {color:#3865B8;}
h1 span {color:#ccc;font-size:10px;margin-left:10px;}
#system {width:99%;float:left;margin:5px 0px 0 0;}
.list ul{ border:1px #ddd solid;  overflow:hidden;border-bottom:none;}
.list ul li{ border-bottom:1px #ddd solid; height:32px;  overflow:hidden;zoom:1; line-height:32px; color:#777;padding-left:5px;}
.list ul li span{ display:block; float:left; color:#777; font-size:14px; width:110px;}

#coprights {width:99%;float:left;margin:5px 0px 0 0;}
#sn {color:#FB0000;font-weight:normal;}
#license {font-weight:normal;color:blue;}
#license a {color:#FB0000;}
</style>
<script language="JavaScript">

function selectall(name) {
	if (document.getElementById("check_box").checked) {
		$("input[name='"+name+"']").each(function() {
			this.checked=true;
		});
	} else {
		$("input[name='"+name+"']").each(function() {
			this.checked=false;
		});
	}
}

function openwin(id,url,title,width,height,lock,yesdo,topurl){ 

	top.box.open("iframe:"+url,title,width,height,{
			id:id,
			submit: function (v, h, f){
				iframeWin = top.box.getIframe(id);
				if (v == 'ok'){
					if(yesdo || topurl){
						if(yesdo){
							yesdo.call(this,iframeWin, id,inputid); 
						}else{
							top.jBox.close(true);
							top.location.href=topurl;
						}
					}else{
						var form = $(iframeWin).contents().find('#dosubmit');
						$(form).click();
						return false;
					}

				}
			}
		});
 
}

function showpicbox(url){
	top.box( '<img src="'+url+'" />',{width:'auto'});
} 
//-->
</script>
</head>
<body width="100%" style="overflow-x:hidden;">
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <div id="lang"> <a href="?m=Index&a=main&menuid=42&l=cn"  class="on">中文</a> <a href="?m=Index&a=main&menuid=42&l=en" >英文</a> </div>
    <ul>
      <a href="/admin.php?m=Index&a=main&menuid=42">后台首页</a>|
    </ul>
  </div>
  <div id="system"  class="list">
    <h1><b>系统信息</b><span>System&nbsp; Info</span></h1>
    <ul>
      <li><span>系统路径:</span><?php echo $_SERVER['DOCUMENT_ROOT'];?></li>
      <li><span>运行环境:</span><?php echo PHP_OS; ?>（<?php echo mysql_get_server_info(); ?>）</li>
      <li><span>服务器端口:</span><?php echo $_SERVER["SERVER_PORT"]; ?></li>
      <li><span>服务器IP:</span><?php echo $_SERVER["HTTP_HOST"]; ?></li>
      <li><span>服务器解译引擎:</span><?echo getenv("SERVER_SOFTWARE");?></li>
      <li><span>服务器语种:</span><? echo getenv("HTTP_ACCEPT_LANGUAGE");?></li>
      <li><span>PHP版本:</span><?php echo PHP_VERSION; ?></li>
    </ul>
  </div>
  <div id="coprights" class="list">
    <h1><b>版权信息</b><span>Copyright Information</span></h1>
    <ul>
      <li><span>程序版本:</span><?php echo  $wzversion?></li>
      <li><span>授权类型:</span><b id="license">未授权</b></li>
      <li><span>技术支持:</span><b id="sn">E-MAIL: avenjan@vip.qq.com</b></li>
      <li><span>程序说明:</span> <b id="update">此程序版权归开发者拥有，任何单位或者个人不得作为商业用途！</b></li>
      <li><span>官方网站:</span></li>
      <li></li>
      <li></li>
    </ul>
  </div>
</div>
</body>
</html>