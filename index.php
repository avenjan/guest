<?php
if(!file_exists(dirname(__FILE__).'/Conf/install.lock')){
  header('Location:install/index.php');
  exit();
}
require 'Conf/inc.php';
require PATH.'Libs/Class/page.class.php';
require PATH.'Libs/Function/fun.php';
$b_id=intval(trim($_GET['id']));
if($b_id==0||$b_id==''){
	$sqltype='';
}else{
	$sqltype="and type_id=$b_id";
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<title><?php echo $wzname." ". $wzversion."  ".$Companyname;?></title>

<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link href="Style/style.css" type="text/css" rel="stylesheet" />
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

 <?php require 'top.php';?>
 <div class="container">
         <?php
        $sql="select id from book where is_view=1 $sqltype order by id desc";
		$ids=$db->get_all($sql,MYSQL_ASSOC);
		if($ids){
		  foreach($ids as $k){
			$xyids.=$k['id'].',';  
		  }
		}
		$xyids=substr($xyids,0,strlen($xyids)-1);
		$total=count($ids);
		$page=new page_link($total,$view_nums);
		$sql="select id,b_name,type_id,b_title,b_content,c_date from book where id in($xyids) and is_view=1 $sqltype order by id desc limit $page->firstcount,$page->displaypg";
		$result=$db->get_all($sql,MYSQL_ASSOC);
		if($result){
			foreach($result as $nums=>$val){
		?>


<!--留言区域-->

		  <dl>
		    <dt class="title">
			#<?php echo ($nums+1);?> [<?php echo $val['b_title'];?>]
			(<?php echo date('Y-m-d',$val['c_date']);?>)
			<span style="float:right">分类<?php echo getclassname($val['type_id'],'book_class','index.php');?></span>
			</dt>
		    <div class="dd">

		      <p><?php echo $val['b_name'];?></p>
			  <p><?php echo $val['b_content'];?></p>

		      
			  <dt class="title">回复信息:</dt>
		    <dd class="dd">

		      <p><?php echo reply_content($val['id'],'book_reply');?></p>

		    </dd>

		    </div>

		  </dl>
<hr/>
<!---->
        <?php
			}
		?>
		</div>
		<?php
		}else{
		?>
<div class="page-header" style="text-align:center">
  <h1><i class="glyphicon glyphicon-exclamation-sign"></i>  暂无留言!</h1>
</div>
<?php
		}
		?>
       
        <?php
		echo $page->show_link();
		?>

<script type="text/javascript">
		(function(){
 
		  $('dd').filter(':nth-child(n+4)').addClass('hideclass');

		  $('dl').on('click', 'dt', function() {
		      $(this).next().slideToggle(200);
		    });
		  
		 })();
	</script>

  <?php require 'foot.php';?>
