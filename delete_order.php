<?php
include_once("dbconnect.php");
$order_id=$_GET['order_id'];
$query=mysqli_query($conn,"DELETE FROM tbl_order WHERE `order_id` = '$order_id'");
echo '<script language="javascript">
     window.location.href="manage_order.php"
     </script>';
?>