<?php

require "../database.php";
require "../model/question.php";

if(isset($_POST['id'])) {    
    $dbconn = new Database("learnit");
    $dbconn->delete("questions", "id", $_POST['id']);
    $status =  $dbconn->getResult();

    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}


?>