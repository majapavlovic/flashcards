<?php

class Question{
    public $id;
    public $question;
    public $answer;
    public $insert_date;
    public $category;
    
    public function __construct($id=null,$question=null,$answer=null,$insert_date=null,$category=null)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->insert_date = $insert_date;
        $this->category = $category;
    }

    public static function selectAll() {
        $dbconn = new Database("learnit");
        $dbconn->select("questions", "*", null, null, null, null);
        return $dbconn->getResult();
    }

    public static function getById($questionId) {
        $dbconn = new Database("learnit");
        $dbconn->select("questions","id, question, answer, insert_date, category_id", null, null, null, "id=$questionId");
        $msqlObj = $dbconn->getResult();
        while($red = $msqlObj->fetch_array(1)){
            $myObj[]= $red;
        }
        return $myObj;
    }

    public static function getColumns() {
        return "question, answer, insert_date, category_id";
    }

    public static function getColumnsArray() {
        $columns = array();
        $columns[] = "question";
        $columns[] = "answer";
        $columns[] = "insert_date";
        $columns[] = "category_id";

        return $columns;
    }

    public function getValues() {
        $values = array();
        $values[]="'$this->question'";
        $values[]="'$this->answer'";  
        $date = date_format($this->insert_date,'Y-m-d H:i:s');
        $values[]= "'$date'";
        $values[]=$this->category;
        return $values;
    }

}
?>