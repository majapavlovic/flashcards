<?php

class Category{
    public $id;
    public $category_name;
    public $insert_date;
    
    public function __construct($id=null,$category_name=null,$insert_date=null)
    {
        $this->id = $id;
        $this->category_name = $category_name;
        $this->insert_date = $insert_date;
    }

    public static function selectAll() {
        $dbconn = new Database("learnit");
        $dbconn->select("categories", "*", null, null, null, null);
        return $dbconn->getResult();
    }
}
?>