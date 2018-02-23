<?php
session_start();
require 'Conf/inc.php';
require PATH.'Libs/Function/fun.php';
$yzcode=md5($yzcode);
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<title><?php echo $wzname."  ".$Companyname;?></title>
<link href="Style/index.css" type="text/css" rel="stylesheet" />
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
.container{text-align:left}

input{ heithg:15px;}
body{ text-align:center}
	</style>
	<script src="Statics/Js/jquery-1.8.3.min.js" language="javascript"></script>
	<script src="Statics/Js/xycms.js" language="javascript"></script>
</head>
<body>
 <?php require 'top.php';?>
<div class="container theme-showcase" role="main" >
<div class="add_book">
          <div class="add_form">
            <div class="title">在线留言</div>
            <div class="form">
              <form action="add_do.php" method="post" name="b_form" id="p_form">
              <input name="b_yzcode" type="hidden" value="<?php echo $yzcode;?>" />
              <input name="b_ip" type="hidden" value="<?php echo getIp();?>" />
              <table width="100%">
                <tr>
                  <td width="15%"><span>留言分类：</span></td>
                  <td width="85%">
                    <select name="type_id" id="type_id" class="b_select">
                      <?php echo book_classlist();?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><span>留言标题：</span></td>
                  <td><input name="b_title" class="b_input" size="40" id="b_title" /> <font color="#FF0000"><i id="b_sm_t"></i> *</font></td>
                </tr>
                <tr>
                  <td><span>留言内容：</span></td>
                  <td><textarea name="b_content" rows="7" cols="50" id="b_content" class="b_textarea"></textarea> <font color="#FF0000">*</font></td>
                </tr>
                <tr>
                  <td><span>姓 名：</span></td>
                  <td><input name="b_name" class="b_input" size="40" id="b_name" /> <font color="#FF0000"><i id="b_n_t"></i> *</font></td>
                </tr>
				<tr>
                  <td><span>运单号：</span></td>
                  <td><input  type="number"   name="dh" class="b_input" size="60" id="dh" /> <font color="#FF0000"><i id="dhunmber"></i> *</font></td>
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
                </tr>
                <tr>
                  <td><span>联系电话：</span></td>
                  <td><input name="b_tel" class="b_input" size="40" /> </td>
                </tr>
                <tr>
                  <td><span>联系邮箱：</span></td>
                  <td><input name="b_mail" class="b_input" size="40" /> </td>
                </tr>
                <tr>
                  <td><span>联系QQ：</span></td>
                  <td><input name="b_qq" class="b_input" size="40" /> </td>
                </tr>
                <tr>
                  <td><span>验证码：</span></td>
                  <td><input name="checkcode" class="b_input" size="8" onclick="xycms_loadcode()"/> <span id="checkCode"></span><span id="tip">点击显示验证码</span></td>
                </tr>
                <tr>
                  <td colspan="2" valign="middle" style=" text-align:center"><input type="submit" value="提交留言" class="b_submit" /></td>
                </tr>
                
              </table>
              </form>
            </div>
            <div class="ms">
              <h3>留言须知：</h3>
              <p>1、严禁对个人、实体、民族、国家等进行漫骂、污蔑与诽谤</p>
              <p>2、网友应遵守我国互联网的相关法规</p>
              <p>3、网友应对所发布的信息承担全部责任</p>
              <p>4、网站管理人员有权保留或删除留言中的信息内容</p>
              <p>5、发表留言即表明已阅读并接受以上条款</p>
            </div>
          </div>
        </div>

</div>


<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

  <?php require 'foot.php';?>
