<?php
session_start();
require 'include/globle.inc.php';
if($_SESSION['m_name']<>""){
	header("Location:master.php");
	exit;
}
?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $wzname." ". $wzversion."  ".$Companyname;?></title>
<link rel="stylesheet" type="text/css" href="style/styles.css">
<style type="text/css">
body,td,th { font-family: "Source Sans Pro", sans-serif; }
body { background-color: #2B2B2B; }
</style>
</head>
<body>
<div class="wrapper">
	<div class="container">
		<h1><?php echo $Companyname;?></h1>
		<form class="form" name="login" method="post" action="loginpass.php" onSubmit="return checkform();">
			<input type="text" name="admin" placeholder="用户名">
			<input type="password" name="password" placeholder="密码">
			<input type="text" name="checkcode"  placeholder="验证码" /> 
			<img src="code.php?act=yes" align="middle" style=" ">
			
			<button type="submit" id="login-button">登陆系统</button>
		</form>
	</div>
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>	
</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
$('#login-button').click(function(event){
	event.preventDefault();
	$('form').fadeOut(500);
	$('.wrapper').addClass('form-success');
});
</script>

</body>
</html>


