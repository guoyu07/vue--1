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

         var_dump($_ids) ;
     $sql = "insert into goodslist (good_id,goodclassfiy,goodname,goodprice,introduce,img,barcode,goodstate,stock)values('$_ids','$type','$name','$price','$describe','$up','$barcode','$opt','$stock')";
		
		$result = excute($sql);

		// if(excute($sql)){
		// 	echo 'good';
		// }else{
		// 	echo 'file';
		// }


    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
