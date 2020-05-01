<?php
class dbconfig{
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $dbname = 'peer_assessment';
	public function connect(){
		$mysqli = new mysqli($this->server,$this->username,$this->password,$this->dbname);
		return $mysqli;		
	}
}
?>