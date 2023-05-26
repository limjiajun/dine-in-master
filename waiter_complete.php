<?php
include_once("dbconnect.php");
$order_id=$_GET['order_id'];
$sql = "UPDATE `tbl_order` SET `waiter_status`='Completed' WHERE `order_id` = '$order_id'";

try{
    $result = $conn->query($sql);
    echo "<script>
    alert('Order Completed');
    </script>";
    echo "<script>
    window.location.href = 'waiterpage.php';
    </script>";
    
} catch (PDOException $e){
    echo "<script>
    alert('Order Fail to Complete');
    </script>";
}
?>