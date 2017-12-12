<?php
header('Access-Control-Allow-Origin:*');
    include "./dbhelpbd.php";
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $sql = "UPDATE orderlist SET orderstate=2 WHERE username='$username' AND orderstate=1";

    $result = excute($sql);

    if ($result) 
         echo "<p>更新成功！</p>";
      else 
         echo "<p>更新失败。</p>";
    //echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>