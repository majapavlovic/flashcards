<?php

require "../database.php";
require "../model/question.php";

if(isset($_POST['question']) && isset($_POST['answer']) && $_POST['category_name']!="" && $_POST['question']!=""
&& $_POST['answer']!="" && $_POST['category_name']!="") {
    $quest = new Question(null,$_POST['question'],$_POST['answer'], new DateTime(), $_POST["category_name"] );
    
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