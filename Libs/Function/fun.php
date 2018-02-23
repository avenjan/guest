

<?php
/**操作成功提示**/
function ok_info($url,$langinfo){
	if($url=='0'){
		echo("
		 <div class='container'>
			<div  class='alert alert-danger' role='alert' style='margin:5% 0 0; padding:5%;text-align: center;'>
				<h2 class='glyphicon glyphicon-remove-sign' aria-hidden='true'></h2>
				<h1 style=' padding:5%;background-color: #d9534f; color:#fff'>
				<strong>ERROR:".$langinfo."</strong><span id='s'></span></h1>
			</div>
		</div>
		<script type='text/javascript'>
　　　　　　　　var time = 5; //时间,秒
　　　　　　　　function Redirect() {
 　　　　　　　　history.go(-1);
　　　　　　　　}
　　　　　　　　var i = 0;
　　　　　　　　function dis() {
 　　　　　　　　document.all.s.innerHTML =  (time - i) + '秒后返回';
 　　　　　　　　i++;
　　　　　　　　}
　　　　　　　　timer = setInterval('dis()', 1000); //显示时间
　　　　　　　　timer = setTimeout('Redirect()', time * 1000); //跳转
　　　　　　</script>
		");		
	}elseif($url=='1'){
	echo("
		 <div class='container'>
			<div  class='alert alert-danger' role='alert' style='margin:5% 0 0; padding:5%;text-align: center;'>
				<h2 class='glyphicon glyphicon-remove-sign' aria-hidden='true'></h2>
				<h1 style=' padding:5%;     background-color: #449d44; color:#fff'>
				<strong>OK".$langinfo."</strong> <span id='s'></span></h1>
			</div>
		</div>
		<script type='text/javascript'>
　　　　　　　　var time = 5; //时间,秒
　　　　　　　　function Redirect() {
 　　　　　　　　history.go(-1);
　　　　　　　　}
　　　　　　　　var i = 0;
　　　　　　　　function dis() {
 　　　　　　　　document.all.s.innerHTML =  (time - i) + '秒后返回';
 　　　　　　　　i++;
　　　　　　　　}
　　　　　　　　timer = setInterval('dis()', 1000); //显示时间
　　　　　　　　timer = setTimeout('Redirect()', time * 1000); //跳转
　　　　　　</script>
		");
	
	}else{
		echo("
		 <div class='container'>
			<div  class='alert alert-success' role='alert' style='margin:5% 0 0; padding:5%;text-align: center;'>
				<h2 class='glyphicon glyphicon-ok-sign' aria-hidden='true'></h2>
				
				<h1 style=' padding:5%;     background-color: #449d44; color:#fff'>
				<strong>OK".$langinfo."</strong> <span id='s'></span></h1>
			</div>
		</div>

		　<script type='text/javascript'>
　　　　　　　　var time = 5; //时间,秒
　　　　　　　　function Redirect() {
 　　　　　　　　window.location = '$url';
　　　　　　　　}
　　　　　　　　var i = 0;
　　　　　　　　function dis() {
 　　　　　　　　document.all.s.innerHTML =  (time - i) + '秒后返回';
 　　　　　　　　i++;
　　　　　　　　}
　　　　　　　　timer = setInterval('dis()', 1000); //显示时间
　　　　　　　　timer = setTimeout('Redirect()', time * 1000); //跳转
　　　　　　</script>
");
		
	}
	exit;
}

function getIp() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				$ip = getenv("REMOTE_ADDR");
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
				else
					$ip = "unknown";
	return ($ip);
}

function xy_rep($str){ 
return str_replace(array('#', '@', '\'','or'),'', $str);
}

function str_cut($string, $length, $dot = '...',$charset) {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$length = intval($length-strlen($dot)-$length/3);
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
		$replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut.$dot;
}

function injCheck($sql_str) { 
	$check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
	if ($check) {
		ok_info('/index.php','非法字符');
		exit;
	} else {
		return $sql_str;
	}
}

//以下函数涉及数据库操作
function getclassname($cid,$table,$url){
	global $db;
	$sqll="select id,title from `{$table}` where id=".$cid."";
	$rows=$db->get_one($sqll,MYSQL_ASSOC);
	if($rows){
		return "<a href='".$url."?id=".$rows['id']."' target='_self'>".$rows['title']."</a>";
	}else{
		return ;
	}
}

function reply_content($rid,$table){
	global $db;
	$sqll="select id,r_name,r_content,r_date from `{$table}` where b_id=".$rid."";
	$rows=$db->get_all($sqll,MYSQL_ASSOC);
	$reply_list='';
	if($rows){
		foreach($rows as $data=>$v){
			$reply_list.="<div class='reply'><strong>".$v['r_name']."回复：</strong>".$v['r_content']."</div>";
		}
	}else{
		$reply_list.="<div class='reply'><strong>管理员回复：</strong>暂未回复，留言正在处理中...</div>";
	}
	return $reply_list;
}

function book_classlist(){
	global $db;
	$sqllist="select id,title from `book_class` order by c_order asc";
	$rowlist=$db->get_all($sqllist,MYSQL_ASSOC);
	if($rowlist){
		foreach($rowlist as $data=>$v){
			$class_list.="<option value='".$v['id']."'>".$v['title']."</option>";
		}
	}else{
		$class_list="<option value=''>无分类</option>";
	}
	return $class_list;
}
?>