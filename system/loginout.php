<?php 
session_start();
header('Content-Type:text/html;charset=utf-8');
session_destroy();//销毁session文件
unset($_SESSION);
echo "<script language='javascript'>"; 
echo "alert('恭喜你，退出成功！！');";
echo " location='index.php';"; 
echo "</script>";
?>