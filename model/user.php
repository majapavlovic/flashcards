<?php

class User{
    public $id;
    public $username;
    public $password;

    public function __construct($id=null,$username=null,$password=null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public static function logIn($user) {
        $dbconn = new Database("learnit");
        $dbconn->select("users", "*", null, null, null, "username='$user->username' and password='$user->password'", null);
        return $dbconn->getResult();

    }
}
?>