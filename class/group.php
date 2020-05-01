<?php
class group{
    public function createGroup($fields){
        $coursewrkid = $fields['coursewrkid'];
        $title = $fields['title'];
        $description = $fields['description'];
        $submittedby = $fields['submittedby'];
        $sqlQuery = "INSERT INTO groups(coursewrkid, title, description, submittedby) VALUES('".$coursewrkid."','".$title."','".$description."','".$submittedby."')";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $response = '';
        if ($result>0) {
            $response = array("status"=>"success","msg"=>"<strong>".$title."</strong> has been successfully created!");
        }else{
            $response = array("status"=>"error","msg"=>"An error has occurred creating <strong>".$title."</strong> !");
        }
        return $response;
    }
    public function getAllCreatedGroups(){
        $sqlQuery = "SELECT g.id, c.name, g.title, g.description, g.datesubmitted, g.status FROM groups g INNER JOIN coursewrk c ON g.coursewrkid=c.id ORDER BY g.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function getGroupById($groupsid){
        $sqlQuery = "SELECT g.id, c.name, g.title, g.description, u.id AS usersid, g.datesubmitted, g.status FROM groups g INNER JOIN coursewrk c ON g.coursewrkid=c.id INNER JOIN users u ON g.submittedby=u.id WHERE g.id=".$groupsid;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function AssignStudent($fields){
        $groupsid = $fields['groupsid'];
        $usersid = $fields['usersid'];
        $sqlQuery = "INSERT INTO groups_assigned(groupsid, usersid) VALUES('".$groupsid."','".$usersid."')";
        $isGroupAssignedToSameStudent = $this->checkGroupAssignToSameStudent($groupsid, $usersid);
        if ($isGroupAssignedToSameStudent==0) {
            $QueryExecutor = new query();
            $result = $QueryExecutor::customQuery($sqlQuery);
            $response = '';
            if ($result>0) {
                $response = array("status"=>"success","msg"=>"This student has been assigned successfully!");
                $parameter='GA';
                $this->updateGroupStatus($groupsid,$parameter);
            }else{
                $response = array("status"=>"error","msg"=>"An error has occurred assigning this student!");
            }
        }
        else{
            $response = array("status"=>"error","msg"=>"This student has already been assigned to this group!");
        }
        return $response;
    }
    public function checkGroupAssignToSameStudent($groupsid, $usersid){
        $sqlQuery = "SELECT * FROM groups_assigned WHERE groupsid=".$groupsid." AND usersid=".$usersid;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $recordFound = $result->num_rows;
        return $recordFound;
    }
    public function updateGroupStatus($groupsid,$parameter){
        $sqlQuery = "UPDATE groups SET status='".$parameter."' WHERE id=".$groupsid;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
    }
    public function getFeedbackToGroup($groupsid){
        $sqlQuery = "SELECT ga.id, ga.groupsid, u.id AS usersid, u.firstname, u.lastname, ga.dateassigned FROM groups_assigned ga INNER JOIN users u ON ga.usersid=u.id WHERE ga.groupsid=".$groupsid." ORDER BY ga.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function getAllActiveGroups(){
        $sqlQuery = "SELECT g.id, c.name, g.title, g.description, u.id AS usersid, u.firstname, u.lastname, g.status AS submit_status, ga.status AS group_status FROM groups g INNER JOIN coursewrk c ON g.coursewrkid=c.id INNER JOIN users u ON g.submittedby=u.id LEFT JOIN groups_assigned ga ON g.id=ga.groupsid WHERE g.status='GA' ORDER BY g.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function StudentAssignedToActiveGroups($usersid){
        $sqlQuery = "SELECT g.id, c.name, g.title, g.description, u.id AS usersid, u.firstname, u.lastname, g.status AS submit_status, ga.status AS group_status FROM groups g INNER JOIN coursewrk c ON g.coursewrkid=c.id INNER JOIN users u ON g.submittedby=u.id LEFT JOIN groups_assigned ga ON g.id=ga.groupsid WHERE ga.usersid=".$usersid." AND ga.status='' ORDER BY g.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function submitFeedback($fields){
        $groupsid = $fields['groupsid'];
        $submittedby = $fields['submittedby'];
        $comment = $fields['comment'];
        $file = $fields['file'];
        $sqlQuery = "INSERT INTO feedback(groupsid, submittedby, comment, file) VALUES('".$groupsid."','".$submittedby."','".$comment."','".$file."')";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        $response = '';
        if ($result>0) {
            $response = array("status"=>"success","msg"=>"Your feedback has been submitted successfully!");
            $this->updateGroupAssignedStatus($groupsid, $submittedby);
        }else{
            $response = array("status"=>"error","msg"=>"An error occurred submitting your feedback!");
        }
        return $response;
    }
    public function updateGroupAssignedStatus($groupsid,$usersid){
        $sqlQuery = "UPDATE groups_assigned SET status='GF' WHERE groupsid=".$groupsid." AND usersid=".$usersid;
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
    }
    public function GroupFeedbackByStudents($usersid){
        $sqlQuery = "SELECT g.id AS groupsid, g.id AS coursewrkid, c.name, g.title, g.coursewrkid, g.description, g.submittedby, g.datesubmitted, u.id AS usersid, u.firstname, u.lastname, u.photo, ga.dateassigned, ga.status FROM groups_assigned ga INNER JOIN groups g ON ga.groupsid=g.id INNER JOIN coursewrk c ON g.coursewrkid=c.id INNER JOIN users u ON ga.usersid=u.id WHERE ga.usersid=".$usersid." AND ga.status='GF' ORDER BY ga.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function GroupsWithFeedback(){
        $sqlQuery = "SELECT g.id AS groupsid, g.id AS coursewrkid, c.name, g.title, g.coursewrkid, g.description, g.submittedby, g.datesubmitted, u.id AS usersid, u.firstname, u.lastname, u.photo, u.role, ga.dateassigned, ga.status, f.comment, f.file AS feedbackfile, f.datecreated AS feedbackdate FROM groups_assigned ga INNER JOIN groups g ON ga.groupsid=g.id INNER JOIN coursewrk c ON g.coursewrkid=c.id INNER JOIN users u ON ga.usersid=u.id INNER JOIN feedback f ON g.id=f.groupsid WHERE ga.status='GF' ORDER BY ga.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
    public function FeedbackByStudent($groupsid,$usersid){
        $sqlQuery = "SELECT f.id AS feedbackid, g.coursewrkid, g.id AS groupsid, g.title, g.description, g.datesubmitted, u.id AS usersid, u.firstname, u.lastname, u.photo, f.comment, f.file, f.datecreated FROM feedback f INNER JOIN groups g ON f.groupsid=g.id INNER JOIN users u ON f.submittedby=u.id WHERE f.groupsid=".$groupsid." AND f.submittedby='".$usersid."' ORDER BY f.id DESC";
        $QueryExecutor = new query();
        $result = $QueryExecutor::customQuery($sqlQuery);
        return $result;
    }
}
?>