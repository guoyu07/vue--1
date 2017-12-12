<?php



header('Access-Control-Allow-Origin:*');
$servername='10.3.135.29';
$username='root';
$passWord='';
$database='mydatabase';

//连接注册登录数据库
$conn = new mysqli($servername,$username,$passWord,$database);

//检测连接
if($conn->connect_error){
    die('连接失败'.$conn->connect_error);
}

//设置编码
$conn->set_charset('utf8');

?>