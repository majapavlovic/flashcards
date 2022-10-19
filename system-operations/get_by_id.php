<?php

require "../database.php";
require "../model/question.php";

if(isset($_POST['id'])) {
    $questionId = $_POST['id'];
    $myObj = Question::getById($questionId);
    // echo $myObj;
    // var_dump($myObj);
    // if($status){
        echo json_encode($myObj);
    // }else{
        // echo $status;
        // echo "Failed";
    // }
}

?>