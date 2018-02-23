<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<title>管理员管理</title>
<script language="javascript">
function ask(msg) {
	if( msg=='' ) {
		msg='警告：删除后将不可恢复，可能造成意想不到后果？';
	}
	if (confirm(msg)) {
		return true;
	} else {
		return false;
	}
}
</script>
</head>
<body>
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_user.php">管理员管理</a>| <a href="add_user.php">添加管理员</a>
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	//|str_replace=.'/index.php','',###
	var onurl ='manage_user.php';
	jQuery(document).ready(function(){
		$('#nav ul a ').each(function(i){
		if($('#nav ul a').length>1){
			var thisurl= $(this).attr('href');
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
  <form name="addform" action="" method="post">
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="40">M_id</th>
            <th>管理用户名</th>
            <th width="140">登陆次数</th>
            <th width="220">管理操作</th>
          </tr>
        </thead>
        <tbody>
          <?php echo get_list();?>
        </tbody>
      </table>
    </div>
  </form>
</div>
</body>
</html>
<?php
//返回字符串（正在使用）
function get_list() { 
    global $db;
    $sql = "select * from `admin_user` where id !='0' order by id asc";  
	//隐藏ID为0的账号
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集
		    $str .="<tr>";
			$str .="<td align='center'>".$row['id']."</td>";
			$str .="<td align='center'>".$row['u_name']."</td>";
			$str .="<td align='center'>".$row['login_nums']."</td>";
			$str .="<td align='center'><a href='edit_user.php?id=".$row['id']."' class='a_btn'>修改</a> | <a href=\"javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_user.php?id=".$row['id']."';\" onClick=\"delcfm();\" class='a_btn'>删除</a></td>";
			$str .="</tr>";  
        } 
    } 
    return $str; 
} 
?>