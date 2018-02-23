<?php
require '../system/include/session.php';
require '../system/include/globle.inc.php';
//登录验证

//修改配置文件
$str="";
$fp=fopen("../Libs/Function/globle.php",'r');
while(!feof($fp)){
$buf = fgets($fp);
$buf = str_replace($Companyname,$_POST["Companyname"],$buf);
$buf = str_replace($wzname,$_POST["wzname"],$buf);
$buf = str_replace($view_nums,$_POST["view_nums"],$buf);
$buf = str_replace($siteinfo,$_POST["siteinfo"],$buf);
$buf = str_replace($foot,$_POST["foot"],$buf);
$str .=$buf;
}
$fp2 = fopen("../Libs/Function/globle.php","w");
fwrite($fp2,$str);
fclose($fp2);
fclose($fp);

ok_info('1','设置保存成功！');
	




?>
