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
<script type="text/javascript" src="Js/check.js"></script>
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
      <a href="manage_log.php">登陆日志</a>
    </ul>
    <div class="clear"></div>
  </div>
  <form name="addform" action="?del=checkbox" method="post">
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="30"><input type="checkbox" name="allbox" id="check_box" onclick="CheckAll()"></th>
            <th width="40">M_id</th>
            <th>登陆用户名</th>
            <th width="140">登陆时间</th>
            <th width="140">登陆IP</th>
            <th width="220">管理操作</th>
          </tr>
        </thead>
        <tbody>
          <?php echo get_list();?>
        </tbody>
      </table>
    </div>
    <div class="btn">
      <select name="lx" id="lx" class="input_select">
        <option selected="selected" value="">操作类型</option>
        <option value="1">批量删除</option>
      </select>
      <input type="submit" class="button" name="dosubmit" value="提交操作" />
    </div>
  </form>
</div>
</body>
</html>
<?php
//返回字符串（正在使用）
function get_list() { 
    global $db;
    $sql = "select * from `admin_login_log` order by id desc";  
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集
		    $str .="<tr>";
			$str .="<td  width='30' align='center'><input class='inputcheckbox' name='id[]' id='id[]' value='".$row['id']."' type='checkbox' ></td>";
			$str .="<td align='center'>".$row['id']."</td>";
			$str .="<td align='center'>".$row['u_name']."</td>";
			$str .="<td align='center'>".date('Y-m-d',$row['login_date'])."</td>";
			$str .="<td align='center'>".$row['login_ip']."</td>";
			$str .="<td align='center'><a href=\"javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_log.php?id=".$row['id']."';\" onClick=\"delcfm();\" class='a_btn'>删除</a></td>";
			$str .="</tr>";  
        } 
    } 
    return $str; 
}

if($_GET['del']=='checkbox'){
	$ids=$_POST['id'];
	if(empty($ids)){
		echo"<script>alert('必须选择一个ID,才可以操作!');history.back(-1);</script>";  
        exit; 
	}else{
		$cz_lx=$_POST['lx'];
		if($cz_lx==''){
			echo"<script>alert('必须选择一个有效操作!');history.back(-1);</script>";  
			exit;
		}
		$id=implode(",",$ids);
		switch($cz_lx){
			case 1:
			$sql="DELETE from `admin_login_log` where id in ($id)";
			$db->query($sql);
			break;
		} 
		echo "<script>alert('恭喜你，操作成功！');window.location.href='manage_log.php';</script>";  
	}
}
$db->close();
?>