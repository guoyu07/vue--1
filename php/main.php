<?php
/**
 * @Author: Marte
 * @Date:   2017-12-08 15:41:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-08 17:11:50
 */
    include "DBHelper.php";
        $id=$_GET("id");
        $sql="delete form student where id=($id)";
        mysql_query($sql,$conn);
?>