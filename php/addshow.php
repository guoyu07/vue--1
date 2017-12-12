<?php
/**
 * @Author: Marte
 * @Date:   2017-12-11 22:43:07
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-12 10:51:39
 */
header('Access-Control-Allow-Origin:*');
    include "./dbhelpbd.php";
    $data = isset($_POST['data']) ? $_POST['data'] : '';
    $username = isset($_POST['username']) ? (int)$_POST['username'] : '';
    echo $data;
    $sql = "UPDATE orderlist SET orderDetail= '$data' WHERE username='$username' AND orderstate=1";

    $result = excute($sql);

    if ($result) 
         echo "<p>更新成功！</p>";
      else 
         echo "<p>更新失败。</p>";
    //echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>