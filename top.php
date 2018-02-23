<?php
!defined('BOOK') && exit('FORBIDDEN');
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php echo $Companyname." | ".$wzname;?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
		  <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          按分类查看<span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
		<?php
			$xy_sql="select * from book_class order by c_order asc";
			$result=$db->query($xy_sql); 
			while($row=mysql_fetch_array($result)){
				?>
			<li><a href="index.php?id=<?php echo $row['id']; ?>"><?php echo $row['title'];;?></a></li>
			<?php
			}
			?>
          
          
        </ul>
      </li>
            <li><a href="system/"><button type="submit" class="btn btn-success">系统管理</button></a></li>
          </ul>
          
        </div>
      </div>
    </nav> 
<div class="jumbotron" style="background:#6f5499;margin-top: 65px; color:#fff">
        <h1><?php echo $Companyname;?></h1>
        <p class="lead"><?php echo $siteinfo;?></p>
        <p><a class="btn btn-lg btn-success" href="add_book.php" role="button">添加留言</a></p>
      </div>

<!--div id="header"><img src="Style/Images/top.jpg" /></div-->