<?php
/**
 * @Author: Marte
 * @Date:   2017-11-16 20:36:53
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-12 17:11:11
 */

    include "./public.php";   
   


    // 接受前端数据
    $orderId = isset($_POST['orderId']) ? $_POST['orderId'] :'';
    $orderDetail = isset($_POST['orderDetail']) ? $_POST['orderDetail'] :'';
    $username = isset($_POST['username']) ? $_POST['username'] :'';
    $orderstate = 1;
    $ordertime = isset($_POST['ordertime']) ? $_POST['ordertime'] :'';    
    echo $orderDetail;
    $sql="insert into orderlist(orderId,orderDetail,username,orderstate,ordertime)  values ('$orderId','$orderDetail','$username','$orderstate','$ordertime')";
    $result = $conn->query($sql);
    
    if ($result===TRUE) {
        // 写入成功
        echo "ok";
    } else {
        // 写入失败
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
        

    //关闭连接
    $conn->close();

?>