<?php
class sanitize{
	static function clean($field){
		$result = trim(addslashes(htmlentities(htmlspecialchars($field))));
 		return $result;
	}
}
?>