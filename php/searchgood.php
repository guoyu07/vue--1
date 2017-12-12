<?php
/**
 * @Author: Marte
 * @Date:   2017-11-16 20:36:53
 * @Last Modified by:   Marte
 */
    include "public.php";   
    
    // 接受前端数据
    $barcode = isset($_POST['barcode']) ? $_POST['barcode'] : '';

    
    $sql = "select * from goodslist where barcode='$barcode'"; 
    

    // 获取查询结果
    $result = $conn->query($sql);

    // $row = $result->fetch_row();
    $row = $result->fetch_all(MYSQLI_ASSOC);
    

    if($row){
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
        
    }else{
        echo 'fail';
    }
    // // 释放查询内存(销毁)
    $result->free();

    //关闭连接
    $conn->close();

?>