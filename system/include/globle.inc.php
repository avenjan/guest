<?php
define('BOOK', true);
define('IN', str_replace('system/include/globle.inc.php', '', str_replace('\\', '/', __FILE__)));
ini_set("magic_quotes_runtime",0);
//set_magic_quotes_runtime(0);
//session_start();
require IN . 'Conf/inc.php';;
require IN . 'Libs/Function/fun.php';
?>