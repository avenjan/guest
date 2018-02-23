<?php
/**  
* 数据库操作类
*/
!defined('BOOK') && exit('FORBIDDEN');
class mysql{
	var $query_num = 0;
	var $link;
	
	function mysql($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
		$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	}

	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
        global $dbcharset;
        $func = empty($pconnect) ? "mysql_connect" : "mysql_pconnect";
        if(!$this->link = @$func($dbhost, $dbuser, $dbpw, 1)) {
        	$this->halt("Can not connect to MySQL server");
        }
        
		if($this->server_info() > '5.0'){
			mysql_query("SET sql_mode=''", $this->link);
		}
		if($dbname) {
			if (!@mysql_select_db($dbname, $this->link)){
				$this->halt('Cannot use database '.$dbname);
			}
		}
	}

	function select_db($dbname) {
		$this->dbname = $dbname;
		if (!@mysql_select_db($dbname, $this->link)){
			$this->halt('Cannot use database '.$dbname);
		}
	}

	function server_info() {
		return mysql_get_server_info($this->link);
	}
	
	function version() {
		return mysql_get_server_info($this->link);
	}
	
	
	function insert($tableName, $column = array()) {
         $columnName = "";
         $columnValue = "";
         foreach ($column as $key => $value) {
             $columnName .= $key . ",";
             $columnValue .= "'" . $value . "',";
         }
         $columnName = substr($columnName, 0, strlen($columnName) - 1);
         $columnValue = substr($columnValue, 0, strlen($columnValue) - 1);
         $sql = "INSERT INTO $tableName($columnName) VALUES($columnValue)";
         $this->query($sql);
     }
	 
	function update($tableName, $column = array(), $where = "") {
         $updateValue = "";
         foreach ($column as $key => $value) {
             $updateValue .= $key . "='" . $value . "',";
         }
         $updateValue = substr($updateValue, 0, strlen($updateValue) - 1);
         $sql = "UPDATE $tableName SET $updateValue";
         $sql .= $where ? " WHERE $where" : null;
         $this->query($sql);
     }
	 function delete($tableName, $where = ""){
         $sql = "DELETE FROM $tableName";
         $sql .= $where ? " WHERE $where" : null;
         $this->query($sql);
     }
	 function select($tableName, $columnName = "*", $where = "") {
         $sql = "SELECT " . $columnName . " FROM " . $tableName;
         $sql .= $where ? " WHERE " . $where : null;
         $this->query($sql);
     }
	 function get_all($sql,$result_type = MYSQL_ASSOC) {
        $query = $this->query($sql);
        $i = 0;
        $rt = array();
        while($row =& mysql_fetch_array($query,$result_type)) {
            $rt[$i]=$row;
            $i++;
        }
        //$this->write_log("获取全部记录 ".$sql);
        return $rt;
    }


    function fetchRow($query){
        return mysql_fetch_assoc($query);
    }
	
	function query($sql) {
        //$this->write_log("查询 ".$sql);
		mysql_query("set names utf8");
        $query = mysql_query($sql,$this->link);
        //if(!$query) $this->halt('Query Error: ' . $sql);
        return $query;
    }
	//获取第一个字段值
    function getOne($sql, $limited = false){
        if ($limited == true){
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false){
            $row = mysql_fetch_row($res);

            if ($row !== false){
                return $row[0];
            }else{
                return '';
            }
        }else{
            return false;
        }
    }
	
	
	function fetch_array($query, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($query, $result_type);
    }
	
	//输出记录
	function fetch_first($sql) {
		$res=$this->query($sql);
		return $this->fetch_array($res,MYSQL_ASSOC);
	}
	
	// 取得一条数据记录
	function get_one($sql, $result_type = MYSQL_ASSOC){
		$result = $this->query($sql);
		$record = $this->fetch_array($result, $result_type);
		return $record;
	}

    function getRow($sql, $limited = false){
        if ($limited == true){
            $sql = trim($sql . 'LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false){
            return mysql_fetch_assoc($res);
        }else{
            return false;
        }
    }

    
    //取影响条数 
	function affected_rows() {
		return mysql_affected_rows($this->link);
	}
	//从结果集中取得一行作为枚举数组 
	function fetch_row($query) {
		return mysql_fetch_row($query);
	}
	// 结果条数
	function num_rows($query) {
		return mysql_num_rows($query);
	}
	// 取字段总数 
	function num_fields($query) {
		return mysql_num_fields($query);
	}
	// 返回查询结果
	function result($query, $row) {
		$query = mysql_result($query, $row);
		return $query;
	}
	//释放结果集 
	function free_result($query) {
		return mysql_free_result($query);
	}
	//返回自增ID 
	function insert_id() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}


	function close() {
		return mysql_close($this->link);
	}

    function error() {
        return (($this->link) ? mysql_error($this->link) : mysql_error());
    }
    //返回错误信息 
    function errno() {
        return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
    }

	function halt($msg = '') {
        global $charset;
		$msg = "<html>\n<head>\n";
		$msg .= "<meta content=\"text/html; charset=$charset\" http-equiv=\"Content-Type\">\n";
		$msg .= "<style type=\"text/css\">\n";
		$msg .=  "body,p,pre {\n";
		$msg .=  "font:12px Verdana;\n";
		$msg .=  "}\n";
		$msg .=  "</style>\n";
		$msg .= "</head>\n";
		$msg .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#006699\" vlink=\"#5493B4\">\n";
		$msg .= "<b>error</b>: ".htmlspecialchars($this->error())."\n<br />";
		$msg .= "<b>error number</b>: ".$this->errno()."\n<br />";
		$msg .= "<b>Date</b>: ".date("Y-m-d @ H:i")."\n<br />";
		$msg .= "<b>Script File</b>: http://".$_SERVER['HTTP_HOST'].getenv("REQUEST_URI")."\n<br />";

		$msg .= "</body>\n</html>";
		echo $msg;
		exit;
	}
}
?>