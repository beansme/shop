<?php
	class SQLHelper{
		private $conn;
		private $host='localhost';
		private $username='root';
		private $password='';
		private $database='shop';

		public function __construct(){
			$this->conn=mysql_connect($this->host,$this->username,$this->password);
			if(!$this->conn){
				die('����ʧ�ܣ�'.mysql_error());
			}
			mysql_select_db($this->database,$this->conn) or die('ѡ�����ݿ�ʧ�ܣ�'.mysql_error());
			mysql_query('set names utf8',$this->conn);
		}
		public function dml($sql){
			$res=mysql_query($sql,$this->conn) or die('�������'.mysql_errno());
			if($res){
				if(mysql_affected_rows($this->conn)>0){
					return 1;
				}else{
					return 2;
				}
			}else{
				return 0;
			}
		}
		public function dql($sql){
			$res=mysql_query($sql,$this->conn) or die('�������'.mysql_errno());
			$arr=array();
			$i=0;
			while($row=mysql_fetch_assoc($res)){
				$arr[$i++]=$row;
			}
			mysql_free_result($res);
			return $arr;
		}
		public function close(){
			if(!empty($this->conn)){
				mysql_close($this->conn);
			}
		}
	}
?>