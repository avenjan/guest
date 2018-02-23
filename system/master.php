<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统 - <?php echo $Companyname;?></title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />

</head>
<body style="background:#E2E9EA">
<div id="header" class="header">


<?php
//管理员权限控制
    $sql = "select * from `admin_user` where u_name='".$_SESSION['m_name']."'";  
    $result =$db->query($sql);//查询pid的子类的分类 
    $userinfos = mysql_fetch_array($result);//变量容器
?>
  <div class="logo"><?php echo $wzname;?></div>
  <div class="nav f_r"> </i> 技术支持: E-mail:avenjan@vip.qq.com &nbsp;&nbsp;&nbsp;&nbsp;</div>
  <div class="nav">&nbsp;&nbsp;&nbsp;&nbsp;欢迎你！【<?php echo $userinfos['name'];?>】<i>|</i> [<a href="loginout.php" target="_top">退出</a>] <i>|</i> <a href="../" target="_blank">浏览站点</a> <i>|</i> </div>
  <div class="topmenu">
    <ul>
	
      <li id='menu_1'><span><a href='javascript:void(0);' onClick='sethighlight(1);'>后台首页</a></span></li>
      <li id='menu_2'><span><a href='javascript:void(0);' onClick='sethighlight(2);'>留言管理</a></span></li>
	  <?php
	if ($userinfos['type']=='9'){
		echo ("
      <li id='menu_3'><span><a href='javascript:void(0);' onClick='sethighlight(3);'>系统设置</a></span></li>
		");}
  ?>
    </ul>
  </div>
  <div class="header_footer"></div>
</div>
<div id="Main_content">
  <div id="MainBox" >
    <div class="main_box">
      <iframe name="main" id="Main" src='system.php' frameborder="false" width="100%" height="auto" allowtransparency="true"></iframe>
    </div>
  </div>
  <div id="leftMenuBox">
    <div id="leftMenu">
      <div style="padding-left:12px;_padding-left:10px;">
        <dl id="nav_1">
		
          <dt>后台首页</dt>
          <dd id='nav_11'><span><a href='system.php' target='main'>后台首页</a></span></dd>
		  <?php
	if ($userinfos['type']=='9'){
		echo ("
          <dd id='nav_12'><span><a href='manage_user.php' target='main'>管理员管理</a></span></dd>
          <dd id='nav_13'><span><a href='manage_log.php' target='main'>后台登陆日志</a></span></dd>
		  <dd id='nav_13'><span><a href='../update/index.html' target='main'>系统更新记录</a></span></dd>
		  "); }
	  ?>
        </dl>
        <dl id="nav_2">
          <dt>留言管理</dt>
          <dd id="nav_21"><span><a href="manage_book.php" target="main">留言管理</a></span></dd>
		  <?php
		if ($userinfos['type']=='9'){
		echo ("
          <dd id='nav_22'><span><a href='manage_book_class.php' target='main'>留言分类</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='add_book_class.php' id='' target='main'>添加</a></span></dd>
		"); }
		  ?>
        </dl>
		<?php
		if ($userinfos['type']=='9'){
		echo ("
        <dl id='nav_3'>
          <dt>系统设置</dt>
          <dd id='nav_31'><span><a href='seting.php' target='main'>系统参数</a></span></dd>
        </dl>
		"); }
		  ?>
      </div>
    </div>
    <div id="Main_drop"> <a  href="javascript:toggleMenu(1);" class="on"><img src="images/admin_barclose.gif" width="11" height="60" border="0"  /></a> <a  href="javascript:toggleMenu(0);" class="off" style="display:none;"><img src="images/admin_baropen.gif" width="11" height="60" border="0"  /></a> </div>
  </div>
</div>
<script language="JavaScript">
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};
var getWindowWH = function(){
	  return ["Height","Width"].map(function(name){
	  return window["inner"+name] ||
		document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
	});
}
window.onload = function (){
	if(!+"\v1" && !document.querySelector) { //IE6 IE7
	 document.body.onresize = resize;
	} else { 
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	var str=getWindowWH();
	var strs= new Array();
	strs=str.toString().split(","); //字符串分割
	var h = strs[0] - 95-30;
	$('#leftMenu').height(h);
	$('#Main').height(h); 
	$('#Main_drop').height(h-220); 
}
wSize();


function sethighlight(n) {
	 $('.topmenu li span').removeClass('current');
	 $('#menu_'+n+' span').addClass('current');
	 $('#leftMenu dl').hide();
	 $('#nav_'+n).show();
	 $('#leftMenu dl dd').removeClass('on');
	 $('#nav_'+n+' dd').eq(0).addClass('on');
	 url = $('#nav_'+n+' dd a').eq(0).attr('href'); //框架显示控制
	 window.main.location.href= url;  //框架显示控制
}

$('#leftMenu dl dd').click(function(){
	$('#leftMenu dl dd').removeClass('on');
	$(this).addClass('on');
    window.main.location.href = $(this).find("a").attr("href");
});
function gocacheurl(){
	mainurl = window.main.location.href;
	window.main.location.href= "/admin.php?m=Index&a=cache&forward="+encodeURIComponent(mainurl);
}

function toggleMenu(doit){
	if(doit==1){
		$('#Main_drop a.on').hide();
		$('#Main_drop a.off').show();
		$('#MainBox .main_box').css('margin-left','24px');
		$('#leftMenu').hide();
	}else{
		$('#Main_drop a.off').hide();
		$('#Main_drop a.on').show();
		$('#leftMenu').show();
		$('#MainBox .main_box').css('margin-left','224px');
	}
}	
sethighlight(1);
</script>
<?php
function autoUpdatingCopyright($startYear){
    // given start year (e.g. 2004)
    $startYear = intval($startYear);
    // current year (e.g. 2007)
    $year = intval(date('Y'));
    // is the current year greater than the
    // given start year?
    if ($year > $startYear)
        return $startYear .'-'. $year;
    else
        return $startYear;
}
?>
<div id="footer" class="footer">Powered by <?php echo $Companyname;?>&nbsp; Released&nbsp;Copyright <?php echo '&copy; ' . autoUpdatingCopyright(2008);?> 作者：avenjan QQ:920105110</div>
</body>
</html>