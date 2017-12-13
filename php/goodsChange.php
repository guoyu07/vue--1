<?php

	header('Access-Control-Allow-Origin:*');

    include "DBHelper.php";

    $_ids = isset($_POST['goodid'])? $_POST['goodid'] : '';
     $type  = isset($_POST['type'])? $_POST['type'] : '';
      $name  = isset($_POST['name'])? $_POST['name'] : '';
       $price  = isset($_POST['price'])? $_POST['price'] : '';
        $describe  = isset($_POST['describe'])? $_POST['describe'] : '';
         $up  = isset($_POST['up'])? $_POST['up'] : '';
          $barcode  = isset($_POST['barcode'])? $_POST['barcode'] : '';
           $opt  = isset($_POST['opt'])? $_POST['opt'] : '';
            $stock  = isset($_POST['stock'])? $_POST['stock'] : '';

         //var_dump($_ids) ;
     $sql = "update goodslist set goodclassfiy = '$type',goodname = '$name',goodprice = '$price',introduce = '$describe',img = '$up',barcode = '$barcode',goodstate = '$opt',stock = '$stock' where good_id = '$_ids'";
	
		$result = excute($sql);

		// if(excute($sql)){
		// 	echo 'good';
		// }else{
		// 	echo 'file';
		// }


    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
