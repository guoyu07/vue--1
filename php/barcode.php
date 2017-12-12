 <?php

    include "public.php";   
   

    // 接受前端数据
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    $sql = "select * from memberlist where username='$username'";

    // 获取查询结果
    $result = $conn->query($sql);
    
    $row = $result->fetch_row();

    
    if($row){
        echo 'ok';
    }else{
        echo 'fail';
    }
    

    // // 释放查询内存(销毁)
    $result->free();

    //关闭连接
    $conn->close();

?>