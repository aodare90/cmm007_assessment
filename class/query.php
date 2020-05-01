<?php
class query{
	public static function customQuery($sqlQuery){
	    $mysql = new dbconfig();
		$conn =  $mysql->connect();			
		$result = $conn->query($sqlQuery);
		$conn->close();
		return $result;
		$result->close();
	}
}
?>