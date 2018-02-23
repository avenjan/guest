<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
</head>
<body style="overflow-x:hidden;">
<?php
$d_id = isset ($_GET['id']) ? intval($_GET['id']) : '0' ;
$sql ="delete from `admin_login_log` WHERE id=$d_id";
$res = mysql_query($sql);
if ($res){
	ok_info('manage_log.php',"恭喜你，删除成功！");
	exit;
	}
	else
	{
	ok_info('manage_log.php',"抱歉，删除失败！");
	exit;
	}
$db->close();	
?>
</html>