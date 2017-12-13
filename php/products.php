<?php
    header('Access-Control-Allow-Origin:*');

    include "DBHelper.php";
    $pageSize=isset($_GET['pageSize']) ? $_GET['pageSize']:'';
    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : '';
    $sql = "select * from orderlist";

    $result = query($sql);

    $res = array(
        'data'=>array_slice($result,($currentPage-1)*$pageSize,$pageSize),
        'total'=>count($result)
    );
    echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>


