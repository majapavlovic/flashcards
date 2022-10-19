<?php

require "../database.php";
require "../model/question.php";

if(isset($_POST['question']) && isset($_POST['answer']) && $_POST['category_id']!="" && $_POST['question']!=""
&& $_POST['answer']!="" && $_POST['category_id']!="") {
    $quest = new Question(null,$_POST['question'],$_POST['answer'], new DateTime(), $_POST["category_id"] );
    
    $dbconn = new Database("learnit");
    $dbconn->insert("questions", Question::getColumns(), $quest->getValues());
    $status =  $dbconn->getResult();
    
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}

?>