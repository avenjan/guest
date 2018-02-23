<?php
require 'include/session.php';
require 'include/globle.inc.php';
$sql1="select * from xy_config where id=1";
$rs=$db->get_one($sql1,MYSQL_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="/statics/xyeditor/kindeditor.js"></script>
<script src="/statics/xyeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="/statics/xyeditor/themes/default/default.css" />
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script>
var editor;
KindEditor.ready(function(K) {
  var editor = K.editor({
	allowFileManager : true
  });
  K('#s_img1').click(function() {
	editor.loadPlugin('image', function() {
	editor.plugin.imageDialog({
	imageUrl : K('#wzlogo').val(),
	clickFn : function(img, title, width, height, border, align) {
	K('#wzlogo').val(img);
	editor.hideDialog();
	}
	});
   });
  });
  K('#s_img2').click(function() {
	editor.loadPlugin('image', function() {
	editor.plugin.imageDialog({
	imageUrl : K('#wxlogo').val(),
	clickFn : function(img, title, width, height, border, align) {
	K('#wxlogo').val(img);
	editor.hideDialog();
	}
	});
   });
  });
});
</script>
</head>
<body>
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_setup.php" >系统设置</a>
    </ul>
    <div class="clear"></div>
  </div>
  <form method="post" name="addform" id="addform" action="?act=ok">
    <table cellpadding=0 cellspacing=0 width="100%" class="table_form" >
      <tr>
        <th width="88">网站名称:</th>
        <td width="1222"><input type="text" class="input-text"  name="wzname" value="<?php echo $rs['wzname'];?>" size="40" />
          wzname </td>
      </tr>
      <tr>
        <th width="88">网站网址:</th>
        <td><input type="text" class="input-text"  name="wzurl" value="<?php echo $rs['wzurl'];?>" size="40" />
          wzurl </td>
      </tr>
      <tr>
        <th width="88">网站LOGO:</th>
        <td><input type="text" class="input-text"  name="wzlogo" id="wzlogo" value="<?php echo $rs['wzlogo'];?>" size="70" /> <input type="button" id="s_img1" class="xy_smt" value="选择图片" />
          wzlogo </td>
      </tr>
      <tr>
        <th width="88">微信图片:</th>
        <td><input type="text" class="input-text"  name="wxlogo" id="wxlogo" value="<?php echo $rs['wxlogo'];?>" size="70" /> <input type="button" id="s_img2" class="xy_smt" value="选择图片" />
          wxlogo </td>
      </tr>
      <tr>
        <th width="88">网站ICP:</th>
        <td><input type="text" class="input-text"  name="wzicp" value="<?php echo $rs['wzicp'];?>" size="40" />
          wzicp </td>
      </tr>
      <tr>
        <th width="88">联系电话:</th>
        <td><input type="text" class="input-text"  name="wztel" value="<?php echo $rs['wztel'];?>" size="40" />
          wztel </td>
      </tr>
      <tr>
        <th width="88">站点邮箱:</th>
        <td><input type="text" class="input-text"  name="wzemail" value="<?php echo $rs['wzemail'];?>" size="40" />
          wzemail </td>
      </tr>
      <tr>
        <th width="88">联系地址:</th>
        <td><input type="text" class="input-text"  name="wzaddress" value="<?php echo $rs['wzaddress'];?>" size="70" />
          wzaddress </td>
      </tr>
      <tr>
        <th width="88">网站标题:</th>
        <td><input type="text" class="input-text"  name="wztitle" value="<?php echo $rs['wztitle'];?>" size="70" />
          wztitle </td>
      </tr>
      <tr>
        <th width="88">关键词:</th>
        <td><input type="text" class="input-text"  name="wzkeys" value="<?php echo $rs['wzkeys'];?>" size="70" />
          wzkeys </td>
      </tr>
      <tr>
        <th width="88">网站简介:</th>
        <td><textarea id="" rows="5" cols="80" name="wzdec" class="text_area"><?php echo $rs['wzdec'];?></textarea>
          wzdec </td>
      </tr>
    </table>
    <div class="btn" id="btnbox">
      <INPUT TYPE="submit"  value="保存" class="button" >
      <input TYPE="reset"  value="重置" class="button">
    </div>
  </form>
</div>
</body>
</html>
<?php
if($_GET["act"]==ok){
	$websiteinfo = array(
	    'wzname'=> htmlspecialchars($_POST['wzname'],ENT_QUOTES), 
		'wzurl' => $_POST['wzurl'],
		'wzlogo' => $_POST['wzlogo'],
		'wxlogo' => $_POST['wxlogo'],
		'wzicp' => $_POST['wzicp'],
		'wztel' => $_POST['wztel'],
		'wzemail' => $_POST['wzemail'],
		'wzaddress' => $_POST['wzaddress'],
		'wztitle' => $_POST['wztitle'],
		'wzkeys' => $_POST['wzkeys'],
		'wzdec' => $_POST['wzdec']
		);
	$db->update("xy_config", $websiteinfo,"id=1");
	index_to_html(0);
	$db->close();
    echo "<script language='javascript'>"; 
    echo "alert('恭喜您，网站系统设置成功!');";
    echo " location='manage_setup.php';"; 
    echo "</script>";
}
?>