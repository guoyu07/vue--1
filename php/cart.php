<?php
header('Access-Control-Allow-Origin:*');

    include "./dbhelpbd.php";
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $sql = "select * from orderlist where username = '$username'";
    // if($_POST["qty"]){
    //     $insert = "update orderlist values('" . $_POST["qty"] . "')"
    //     excute($insert)
    // }
    $result = query($sql);

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>