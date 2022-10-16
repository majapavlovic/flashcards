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

}
?>