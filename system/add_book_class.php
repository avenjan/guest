<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/laydate.js"></script>
<script type="text/javascript" src="js/check.js"></script>
</head>
<body style="overflow-x:hidden;">
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_book_class.php">分类管理</a>| <a href="add_book_class.php">分类添加</a>
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	var onurl ='add_book_class.php';
	jQuery(document).ready(function(){
		$('#nav ul a ').each(function(i){
		if($('#nav ul a').length>1){
			var thisurl= $(this).attr('href');
			thisurl = thisurl.replace('&menuid=22','');
			if(onurl.indexOf(thisurl) == 0 ) $(this).addClass('on').siblings().removeClass('on');
		}else{
			$('#nav ul').hide();
		}
		});
		if($('#nav ul a ').hasClass('on')==false){
		$('#nav ul a ').eq(0).addClass('on');
		}
	});
	</script>
  <div id="msg"></div>
  <form name="addform" id="addform" action="?act=ok" method="post">
    <table cellpadding=0 cellspacing=0 class="table_form" width="100%">
      <tr>
        <td width="10%" ><font color="red">*</font>标题</td>
        <td width="90%" >
          <input type="text" class="input-text" name="title"  id="title"  size="55" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" >排序</td>
        <td width="90%" id="box_createtime"><input type="text" class="input-text" name="c_order"  id="c_order" value="1" size="10" /> 【数字，数字越小越靠前】</td>
      </tr>
    </table>
    <div id="bootline"></div>
    <div id="btnbox" class="btn">
      <INPUT TYPE="submit"  value="提交" class="button" onClick='javascript:return checkaddform()'>
      <input TYPE="reset"  value="取消" class="button">
    </div>
  </form>
</div>
</body>
</html>
<?php
if($_GET["act"]==ok){
	$siteinfo = array(
		'title' => $_POST['title'],
		'c_order' => $_POST['c_order']
		);
	$db->insert("book_class", $siteinfo);
	//$db->close();
    echo "<script language='javascript'>"; 
    echo "alert('恭喜您,信息内容添加成功!');";
    echo " location='manage_book_class.php';"; 
    echo "</script>";
}
?>