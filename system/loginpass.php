<?php
session_start();
require 'include/globle.inc.php';
//登录验证
if(strtolower($_POST["checkcode"])==strtolower($_SESSION["randval"])){
  unset($_SESSION["randval"]);//释放session中的变量
}else{
  unset($_SESSION["randval"]);
  ok_info('0','验证码输入有误');
  exit();
}
if(isset($_POST["admin"]) && isset($_POST["password"]) && isset($_POST["checkcode"])){
  $m_name=xy_rep(trim($_POST["admin"]));
  $m_pwd=md5(md5($_POST["password"]));
  $login_ip=getIp();
  $sql="select * from admin_user where u_name='".$m_name."' and u_pwd='".$m_pwd."'";
  $result=$db->query($sql);
  if(!mysql_num_rows($result)==0){
    $_SESSION["m_name"] = $m_name;
	$db->query("UPDATE admin_user SET login_nums=login_nums+1 where u_name='".$m_name."'");
	$login_info=array(
	   'u_name'=>$m_name,
	   'login_date'=>strtotime(date('Y-m-d')),
	   'login_ip'=>$login_ip
	);
	$db->insert("admin_login_log",$login_info);
	$db->close();
	ok_info('master.php','恭喜您，登陆成功!');
  }else{
	ok_info('0','帐号或者密码有误');
	exit();
  }
}
?>
