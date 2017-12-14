<?php

    header('Access-Control-Allow-Origin:*');

    include "DBHelper.php";
    $val = isset($_POST['val'])? $_POST['val'] : '';
    $pageSize=isset($_POST['pageSize']) ? $_POST['pageSize']:'';
    $currentPage = isset($_POST['currentPage']) ? $_POST['currentPage'] : '';
    $sql  = "SELECT * FROM `orderlist` WHERE CONCAT(`orderId`) LIKE '%$val%'";
    $result = query($sql);
$res = array(
        'data'=>array_slice($result,($currentPage-1)*$pageSize,$pageSize),
        'total'=>count($result)
    );
    echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>
