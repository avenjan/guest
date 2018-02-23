<?php
require 'include/session.php';
require 'include/globle.inc.php';
require IN . 'Libs/Class/page.class.php';
$x_id=intval(trim($_GET['bid']));
$x_m=$_GET['act'];
$x_keys=$_POST['keyword'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息管理</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="Js/check.js"></script>
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
<body style="overflow-x:hidden;">
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_reply.php">回复管理</a>
    </ul>
  </div>
  <script>
	//|str_replace=.'/index.php','',###
	
	jQuery(document).ready(function(){

		$('#nav ul a ').eq(0).addClass('on');
	});
	</script>
  <table  class="search_table" width="100%">
    <tr>
      <td class="search"><form action="?act=search" method="post">
          <input id="keyword" type="text" size="14" class="input-text" name="keyword" />
          <input type="submit" value="查询"  class="button" />
          <input type="reset" value="重置" class="button"  />
        </form></td>
    </tr>
  </table>
  <form name="addform" id="addform" action="?del=checkbox" method="post">
   <?php
   if($x_id=='' || $x_id==0){
	   $sql="select id from book_reply";
   }else{
	   $sql="select id from book_reply where b_id=$x_id";
   }
   
   $ids=$db->get_all($sql,MYSQL_ASSOC);
   if($ids){
	   foreach($ids as $k){
		   $xyids.=$k['id'].',';  
	   }
   }
   $xyids=substr($xyids,0,strlen($xyids)-1);
   $total=count($ids);
   $page=new page_link($total,30);
   if($x_m=='search' and $x_keys!=""){
	$xy_sql="select * from book_reply where id in($xyids) and title like '%$x_keys%' order by id desc limit $page->firstcount,$page->displaypg";
   }else{
	$xy_sql="select * from book_reply where id in($xyids) order by id desc limit $page->firstcount,$page->displaypg";
   }
   $result=$db->get_all($xy_sql,MYSQL_ASSOC);
   ?>
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="30"><input type="checkbox" name="allbox" id="check_box" onclick="CheckAll()"></th>
            <th width="40">ID</th>
            <th>回复信息</th>
            <th width="100">回复人</th>
            <th width="100">回复日期</th>
            <th width="140">管理操作</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($result as $row){
			 
		  ?>
          <tr>
            <td  width="30" align="center"><input class="inputcheckbox " name="id[]" id="id[]" value="<?php echo $row['id'];?>" type="checkbox" ></td>
            <td align="center"><?php echo $row['id'];?></td>
            <td><?php echo str_cut((strip_tags($row['r_content'])),160,'...','utf-8');?> </a> &nbsp;&nbsp;</td>
            <td align="center"><?php echo $row['r_name'];?></td>
            <td align="center"><?php echo date('Y-m-d',$row['r_date']);?></td>
            <td align="center"><a href="edit_reply.php?id=<?php echo $row['id'];?>">编辑</a> | <a href="javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_reply.php?id=<?php echo $row['id'];?>';" onClick="delcfm();">删除</a></td>
          </tr>
          <?php
		  }
		  
		  ?>
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
<div id="pages" class="page">
<?php echo $page->show_link();?>
</div>
</body>
</html>
<?php
function getcategoryname($catid){
	global $db;
	$sql="select * from xy_category where cid=$catid";
	$result =$db->query($sql);
	if($result && mysql_affected_rows()){
		$row =$db->get_one($sql,MYSQL_ASSOC);
		echo "[<font color='green'>".$row['cname']."</font>]";
	}else{
		return '';
	}
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
			$sql="DELETE FROM book_reply where id in ($id)";
			$db->query($sql);
		} 
		echo "<script>alert('恭喜你，操作成功！');window.location.href='manage_reply.php';</script>";  
	}
}
$db->close();
?>