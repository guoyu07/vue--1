<?php
/**
 * @Author: Marte
 * @Date:   2017-11-16 20:36:53
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-13 15:01:06
 */

    include "./public.php";   
   


    // 接受前端数据
    $username = isset($_POST['username']) ? $_POST['username'] :'';
    $feedback = isset($_POST['feedback']) ? $_POST['feedback'] :'';
    
    $sql="insert into feedback(username,feedback)  values ('$username','$feedback')";
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