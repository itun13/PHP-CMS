<?php
require('new_config.php');
class Database{
	public $conn;
	public function __construct(){
		$this->open_db_connection();
	}
	public function open_db_connection(){
		$this->conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if($this->conn->connect_errno){
			die('Connection Failed'.$this->conn->connect_errno);
		}
	}
}
$database = new Database();
?>