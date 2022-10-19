<?php

require "../database.php";
require "../model/question.php";

if(isset($_POST['question_id']) && isset($_POST['question']) && isset($_POST['answer']) && $_POST['question_id']!="" && $_POST['category_id']!="" && $_POST['question']!=""
&& $_POST['answer']!="" && $_POST['category_id']!="") {
    $quest = new Question($_POST['question_id'],$_POST['question'],$_POST['answer'], new DateTime(), $_POST['category_id'] );
    $dbconn = new Database("learnit");
    $dbconn->update("questions", $_POST['question_id'], Question::getColumnsArray(), $quest->getValues());
    $status =  $dbconn->getResult();

    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}

?>