<?php
require 'include/session.php';
require 'include/globle.inc.php';
if($_GET["act"]==ok){
	$c_id=$_POST['id'];
	$siteinfo = array(
	    'b_title' => $_POST['title'],
		'dh' => $_POST['dh'],
		'type_id' => $_POST['type_id'],
		'b_content' => $_POST['b_content'],
		'b_name' => $_POST['b_name'],
		'b_tel' => $_POST['b_tel'],
		'b_mail' => $_POST['b_mail'],
		'b_qq' => $_POST['b_qq'],
		'b_ip' => $_POST['b_ip'],
		'is_view' => $_POST['is_view'],
		'c_date' => strtotime($_POST['c_date'])
		);
	$db->update("book", $siteinfo,"id=$c_id");
	//$db->close();
    echo "<script language='javascript'>"; 
    echo "alert('恭喜您,信息修改成功!');";
    echo " location='manage_book.php';"; 
    echo "</script>";
}
$sxid=$_GET["id"];
$e_rs=$db->get_one("select * from book where id=$sxid",MYSQL_ASSOC);
$is_view=$e_rs['is_view'];
$type_id=$e_rs['type_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/laydate.js"></script>
</head>
<body style="overflow-x:hidden;">
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_book.php">留言管理</a>| <a href="add_book.php">添加留言</a>|
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	var onurl ='manage_book.php';
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
  <div id="msg"></div>
  <form name="addform" id="addform" action="?act=ok" method="post">
    <table cellpadding=0 cellspacing=0 class="table_form" width="100%">
      <tr>
        <td width="10%" ><font color="red">*</font>标题</td>
        <td width="90%" >
          <input type="text" class="input-text" name="title"  id="title"  size="55" value="<?php echo $e_rs['b_title'];?>" />
          &nbsp;
          <input type="hidden" name="id" value="<?php echo $sxid;?>" /></td>
      </tr>
	  <tr>
        <td width="10%" ><font color="red">*</font>运单号</td>
        <td width="90%" >
          <input type="number" class="input-text" name="dh"  id="dh"  size="55" value="<?php echo $e_rs['dh'];?>" readonly="true" />
		  <font color="red">运单号不可编辑</font>
		  <a href="http://www.jiugongwuliu.com/select.php?ph=<?php echo $e_rs['dh'];?>" target="_blank">查询运单状态</a>
		   <script>
					$('#dh').bind('input propertychange',function(){ //添加监听input值的改变事件
						   var tvalmum;
							 //统计input输入字段的长度
						   tvalnum = $(this).val().length;
						   //如果大于8个字直接进行字符串截取
						   if(tvalnum>11){          
							 var tval = $(this).val();        
							 tval = tval.substring(0,11);        
							 $(this).val(tval);
							 alert('输入运单号长度超限！'); 
						   }
						});

				  </script>
          &nbsp;
          <input type="hidden" name="id" value="<?php echo $sxid;?>" /></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>信息分类</td>
        <td width="90%" >
          <select name="type_id" class="input_select">
          <?php echo get_str();?>
        </select>
          </td>
      </tr>
      <tr>
        <td width="10%" >留言内容</td>
        <td width="90%"><textarea name="b_content" id="b_content" cols="85" rows="8"><?php echo $e_rs['b_content'];?></textarea></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>留言者姓名</td>
        <td width="90%" >
          <input type="text" class="input-text" name="b_name"  id="b_name"  size="55" value="<?php echo $e_rs['b_name'];?>" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" >联系电话</td>
        <td width="90%" >
          <input type="text" class="input-text" name="b_tel"  id="b_tel"  size="55" value="<?php echo $e_rs['b_tel'];?>" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" >联系邮箱</td>
        <td width="90%" >
          <input type="text" class="input-text" name="b_mail"  id="b_mail"  size="55" value="<?php echo $e_rs['b_mail'];?>" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" >联系QQ</td>
        <td width="90%" >
          <input type="text" class="input-text" name="b_qq"  id="b_qq"  size="55" value="<?php echo $e_rs['b_qq'];?>" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" >留言IP</td>
        <td width="90%" >
          <input type="text" class="input-text" name="b_ip"  id="b_ip"  size="55" value="<?php echo $e_rs['b_ip'];?>" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>发布时间</td>
        <td width="90%" id="box_createtime"><input name="c_date" type='text' class="laydate-icon" id="c_date" value="<?php echo date("Y-m-d",$e_rs['c_date']);?>" /></td>
      </tr>
      <tr>
        <td width="10%" >是否显示</td>
        <td width="90%" id="box_posid"><select id="is_view" name="is_view" class="input_select" >
            <option value="0" <?php if($is_view==0){?> selected="selected"<?php }?>>不显示</option>
            <option value="1" <?php if($is_view==1){?> selected="selected"<?php }?>>显示</option>
          </select></td>
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
<script>
laydate({
    elem: '#c_date', 
    event: 'focus'
	});
</script>
<?php
function get_str() { 
    global $db;
	global $str;
	global $type_id;
    $sql = "select * from book_class order by c_order asc";  
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
		    if($row['id']==$type_id){
				$select="selected='selected'";
			}else{
				$select="";
			}
            $str .= "<option value='".$row['id']."' $select>".$row['title']."</option>"; //构建字符串 
        } 
    } 
    return $str; 
}
$db->close();
?>