<?php
include_once("dbconnect.php");
$menu_id=$_GET['menu_id'];
$query=mysqli_query($conn,"DELETE FROM tbl_menu WHERE `menu_id` = '$menu_id'");
echo '<script language="javascript">
     window.location.href="manage_menu.php"
     </script>';
?>