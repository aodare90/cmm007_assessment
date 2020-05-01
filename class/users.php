<?php
class users{
    private $_password;
    private $_username;

    public function createUsers($firstname,$lastname,$email,$password,$role){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sqlQuery = "INSERT INTO users(username, password, firstname, lastname, email, photo, aboutme, role) VALUES('".$email."','".$password."','".$firstname."','".$lastname."','".$email."','','','".$role."')";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $response = '';
        if ($result>0) {
            $response = array("status"=>"success","msg"=>"[ ".$firstname." ".$lastname." ] has been added successfully!");
        }else{
            $response = array("status"=>"error","msg"=>"An error has occurred adding this student! Please try again!");
        }
        return $response;
    }
    public function getAllUsers(){
        $sqlQuery = "SELECT id, firstname, lastname, email, password, photo, role FROM users ORDER BY id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function changePassword($usersid,$current_password,$new_password){
        $response = '';
        $isCurrentPasswordCorrect = $this->checkCurrentPassword($usersid,$current_password);
        if ($isCurrentPasswordCorrect>0) {
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sqlQuery = "UPDATE users SET password='".$new_password."' WHERE id=".$usersid;
            $QueryExecutor = new query();
            $result = $QueryExecutor::customQuery($sqlQuery);
            if ($result>0) {
                $response = array("status"=>"success","msg"=>"Your password has been updated!");
            }else{
                $response = array("status"=>"error","msg"=>"An error has occurred updating this password! Please try again!");
            }
        }else {
            $response = array("status"=>"error","msg"=>"The current password does not match our records! Please try again!");
        }
        return $response;
    }
    private function checkCurrentPassword($usersid,$current_password){
        $sqlQuery = "SELECT id FROM users WHERE id=".$usersid." AND password='".$current_password."'";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $numOfRecords = $result->num_rows;
        return $numOfRecords;
    }

    public function getUserById($userId){
        $sqlQuery = "SELECT id, username, password, firstname, lastname, email, photo, aboutme FROM users WHERE id=".$userId;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $id=''; $username=''; $password=''; $firstname=''; $lastname=''; $email=''; $photo='';$aboutme='';
        foreach($result as $row) {
            $id=$row['id'];
            $username = $row['username'];
            $password = $row['password'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $photo = $row['photo'];
            $aboutme = $row['aboutme'];
        }
        $response = array("id"=>$id, "username"=>$username, "password"=>$password, "firstname"=>$firstname, "lastname"=>$lastname, "email"=>$email, "photo"=>$photo, "aboutme"=>$aboutme);
        return $response;
    }
    public function login($fields){
        $this->_username = $fields['username'];
        $this->_password = $fields['password'];
        $response = "";
        $sqlQuery = "SELECT id FROM users WHERE username='".$this->_username."' AND password='".$this->_password."'";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $recFound = $result->num_rows;
        if ($recFound>0) {
            $sqlQuery = "SELECT id, firstname, lastname, email, role, photo, aboutme FROM users WHERE username='".$this->_username."' AND password='".$this->_password."'";
            $QueryExecutor = new query();
            $result = $QueryExecutor::customQuery($sqlQuery);
            $recFound = $result->num_rows;
            if ($recFound>0) {
                $myId = "";
                $myFirstname = "";
                $myLastname = "";
                $myEmail = "";
                $myRole = "";
                foreach ($result as $row) {
                    $myId = $row['id'];
                    $myFirstname = $row['firstname'];
                    $myLastname = $row['lastname'];
                    $myEmail = $row['email'];
                    $myPhoto = $row["photo"];
                    $myAboutme = $row["aboutme"];
                    $myRole = $row['role'];
                }
                $status = "success";
                $response = array("status"=>$status,"id"=>$myId,"firstname"=>$myFirstname,"lastname"=>$myLastname,"email"=>$myEmail,"photo"=>$myPhoto,"aboutme"=>$myAboutme,"role"=>$myRole);
            }
        }
        else {
            $status = "error";
            $response = array("status"=>$status,"message"=>"Invalid login credentials! Please try again!");
        }
        return $response;
    }
    public function updateProfile($fields){
        $usersid = $fields["usersid"];
        $firstname = $fields["firstname"];
        $lastname = $fields["lastname"];
        $aboutme = $fields["aboutme"];
        $usersid = $fields["usersid"];
        $sqlQuery = "UPDATE users SET firstname='".$firstname."', lastname='".$lastname."',aboutme='".$aboutme."' WHERE id=".$usersid;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $response = "";
        if ($result>0) {
            $response = array("status"=>"success","message"=>"Your profile has been successfully updated!");
            $this->setUserSessionData($usersid);
        }
        else {
            $response = array("status"=>"error","message"=>"An error has occurred updating your profile! Try again!");
        }
        return $response;
    }
    private function setUserSessionData($usersid){
        $sqlQuery = "SELECT id, firstname, lastname, email,address, aboutme FROM users WHERE id=".$usersid;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        foreach ($result as $row) {
            $_SESSION['myUserId'] = $row['id'];
            $_SESSION['myFirstname'] = $row["firstname"];
            $_SESSION['myLastname'] = $row["lastname"];
            $_SESSION['myEmail'] = $row['email'];
            $_SESSION["myPhoto"] = $row["photo"];
            $_SESSION['myAboutme'] = $row["aboutme"];
        }
    }
    public function uploadAvatar(){
        if ($_FILES["file"]["name"]!='') {
            $fileName = $_FILES['file']['name'];
            $test = explode(".", $fileName);
            $extension = end($test);
            $today = date("Ymd_H_i_s");
            $name = $today.rand(100,999).'.'.$extension;
            $location = '../assets/img/avatars/'.$name;
            $result = move_uploaded_file($_FILES["file"]["tmp_name"], $location);
            $response = array("status"=>$result,"name"=>$name,"location"=>$location);
            return $response;
        }
    }
    public function updateAvatar($name,$location){
        $myUserID = $_SESSION['myUserId'];
        $myPhoto = $_SESSION['myPhoto'];
        $myOldPhoto = "../assets/img/avatars/".$myPhoto;
        $sqlQuery = "UPDATE users SET photo='".$name."' WHERE id=".$myUserID;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        @unlink($myOldPhoto);
        $_SESSION['myPhoto'] = $name;
    }
}
?>