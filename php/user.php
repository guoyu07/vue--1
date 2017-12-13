<?php
header('Access-Control-Allow-Origin:*');

    include "DBHelper.php";
    
    $username = isset($_POST["username"]) ? $_POST["username"] : '111';
    $password = isset($_POST["password"]) ? $_POST["password"] : '111';
    $sql = "select * from user where username = $username and password = $password";

    $result = query($sql);
    echo json_encode($result, JSON_UNESCAPED_UNICODE); 
?>