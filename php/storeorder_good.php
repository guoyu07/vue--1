<?php

    include "./dbhelpbd.php";   
    header('Access-Control-Allow-Origin:*');

    //接受前端数据
    $username = isset($_POST['username']) ? (int)$_POST['username'] : '';
    $orderDetail = isset($_POST['orderDetail']) ? $_POST['orderDetail'] : '';

    $sql = "UPDATE orderlist SET orderDetail='$orderDetail' WHERE username='$username'AND orderstate=1";
    
   
    $result=excute($sql);

    if($result){
        echo "ok";
    }else{
        echo "none";
    }
 
?>