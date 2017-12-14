<?php

    header('Access-Control-Allow-Origin:*');

    include "DBHelper.php";

    $sql  = isset($_POST['sql'])? $_POST['sql'] : '';
    $pageSize=isset($_POST['pageSize']) ? $_POST['pageSize']:'';
    $currentPage = isset($_POST['currentPage']) ? $_POST['currentPage'] : '';

    $result = query($sql);

    $res = array(
        'data'=>array_slice($result,($currentPage-1)*$pageSize,$pageSize),
        'total'=>count($result)
    );

    

    echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>
