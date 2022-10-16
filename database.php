<?php
$host = "localhost";
$db = "learnit";
$username = "root";
$password= "";

$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_errno){
    exit("Connection error: ".$conn->connect_error.", error code: ".$conn->connect_errno);
}
?>