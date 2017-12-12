<?php
/**
 * @Author: Marte
 * @Date:   2017-11-16 20:36:53
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-10 23:06:57
 */
    include "public.php";   
    

    // 接受前端数据
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // 密码md5加密
    $password = md5($password);

    $sql = "select * from memberlist where username ='$username'";

    mysqli_query($conn,"UPDATE memberlist SET password='$password' WHERE username='$username'");

    // 获取查询结果
    $result = $conn->query($sql);

    $row = $result->fetch_all(MYSQLI_ASSOC);

    if($row){
        
        echo json_encode($row,JSON_UNESCAPED_UNICODE);
    }else{
        echo 'fail';
    }
    

    // // 释放查询内存(销毁)
    $result->free();

    //关闭连接
    $conn->close();

?>