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
<form class="form" name="login" method="post" action="doset.php" onSubmit="return checkform();">
  <div id="nav" class="mainnav_title">
    <div id="lang"> <a href="?m=Index&a=main&menuid=42&l=cn"  class="on">中文</a> <a href="?m=Index&a=main&menuid=42&l=en" >英文</a> </div>
    <ul>
      <a href="/admin.php?m=Index&a=main&menuid=42">后台首页</a>|
    </ul>
  </div>
  <div id="system"  class="list">
    <h1><b>修改系统配置</b><span>Development&nbsp; Info</span></h1>
    <ul>
      <li><span>公司名称:</span><input type="text" class="input-text" name="Companyname" size="50" value="<?php echo $Companyname?>"></li>
      <li><span>系统名称:</span><input type="text" class="input-text" name="wzname" size="50" value="<?php echo $wzname?>"></li>  
      <li><span>分页条目:</span><input type="unmber" class="input-text" name="view_nums" size="50" value="<?php echo $view_nums;?>"></li>
       <li><span>系统简介:</span>
	  </li>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea  rows="5" cols="70" name="siteinfo"><?php echo $siteinfo;?></textarea>
		<li><span>页脚代码:</span><font style="font-size:14px;" color="#FF0000">页面底部显示内容</font>
	  </li>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea  rows="5" cols="70" name="foot"><?php echo $foot;?></textarea>
    </ul>
	<hr/>
  </div>
  <input type="submit" value="保存设置" class="button">
</form>
</div>
</body>
</html>