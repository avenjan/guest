<?php
session_start();
require 'Conf/inc.php';
require 'Libs/Function/fun.php';

if (empty($_POST["checkcode"])){
 unset($_SESSION["randval"]);
	  ok_info(0,"请输入验证码！");
	  exit();
}elseif (strtolower($_POST["checkcode"])==strtolower($_SESSION["randval"])){
	  unset($_SESSION["randval"]);//释放session中的变量
}else{
	  unset($_SESSION["randval"]);
	  ok_info(0,"验证码输入有误!");
	  exit();

}
$byz=$_POST['b_yzcode'];
if($byz!==md5($yzcode)){
	ok_info(0,'错误的参数！');
}
$siteinfo = array(
		'type_id' => intval(trim($_POST['type_id'])),
		'b_title' => injCheck($_POST['b_title']),
		'b_content' => injCheck($_POST['b_content']),
		'b_name' => injCheck($_POST['b_name']),
		'dh' => injCheck($_POST['dh']),
		'b_tel' => injCheck($_POST['b_tel']),
		'b_mail' => injCheck($_POST['b_mail']),
		'b_qq' => injCheck($_POST['b_qq']),
		'b_ip' => injCheck($_POST['b_ip']),
		'c_date' => time()
		);
$db->insert("book", $siteinfo);
$db->close();
ok_info('/index.php','恭喜你，留言提交成功！');
?>