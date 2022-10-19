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

    public static function getColumns() {
        return "question, answer, insert_date, category_id";
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