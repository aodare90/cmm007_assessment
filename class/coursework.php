<?php
class coursework{
	public function createCoursework($fullname, $codename){
		    $nameExist = $this->nameAlreadyExist($fullname);
		    $reponse = '';
		    if ($nameExist==0) {
		    	$sqlQuery = "INSERT INTO coursewrk(name,code) VALUES('".$fullname."','".$codename."')";
				$QueryExecutor = new query();
      			$result = $QueryExecutor::customQuery($sqlQuery);
      			if ($result>0) {
      				$response = array("status"=>"success","msg"=>"<strong>".$fullname."</strong> has been successfully created!");
      			}else{
      				$response = array("status"=>"error","msg"=>"There was an error creating this Coursework!");
      			}
		    }else{
		    	$response = array("status"=>"error","msg"=>"This Coursework already exists! Use a different name!");
		    }
			return $response;
	}
	private function nameAlreadyExist($fullname){
			$sqlQuery = "SELECT id FROM coursewrk WHERE name='".$fullname."'";
			$QueryExecutor = new query();
      		$result = $QueryExecutor::customQuery($sqlQuery);
      		$numOfRec = $result->num_rows;
      		return $numOfRec;
	}
	public function getAllCoursework(){
		$sqlQuery = "SELECT id, name, code, datecreated FROM coursewrk ORDER BY id DESC";
		$QueryExecutor = new query();
      	$result = $QueryExecutor::customQuery($sqlQuery);
      	return $result;
	}
	public function getCourseworkById($coursewrkid){
		$sqlQuery = "SELECT id, name, code, datecreated FROM coursewrk WHERE id=".$coursewrkid;
		$QueryExecutor = new query();
      	$result = $QueryExecutor::customQuery($sqlQuery);
      	return $result;
	}
	public function updateCoursework($coursewrkid, $name, $code){
		$sqlQuery = "UPDATE coursewrk SET name='".$name."',code='".$code."' WHERE id=".$coursewrkid;
		$QueryExecutor = new query();
      	$result = $QueryExecutor::customQuery($sqlQuery);
      	$response = '';
      	if ($result>0) {
      		$response = array("status"=>"success","msg"=>"Coursework has been updated successfully!");
      	}else{
      		$response = array("status"=>"error","msg"=>"An error has occurred updating this Coursework! Try again!");
      	}
      	return $response;
	}
	public function deleteCoursework($coursewrkid){
		$sqlQuery = "DELETE FROM coursewrk WHERE id=".$coursewrkid;
		$QueryExecutor = new query();
      	$result = $QueryExecutor::customQuery($sqlQuery);
	}
}
?>