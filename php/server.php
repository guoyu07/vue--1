<?php
		header("Access-Control-Allow-Origin:*");
		/*星号表示所有的域都可以接受，*/
		header("Access-Control-Allow-Methods:GET,POST");

		// 配置参数
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'h5_1705';
		$sql  = isset($_POST['sql'])? $_POST[sql] : '';
		// 1）连接数据库
		$conn = new mysqli($servername,$username,$password,$database);

		// 检测连接
		if($conn->connect_errno){
			die('连接失败：'.$conn->connect_error);
		}

		// 设置字符集
		$conn->set_charset('utf8');

		// 编写查询sql语句
		
		// 利用sql语句查询数据库
		// 查询结果集
		$result = $conn->query($sql);


		// 使用查询结果集
		$row = $result->fetch_all(MYSQLI_ASSOC);


		echo json_encode($row,JSON_UNESCAPED_UNICODE);
?>