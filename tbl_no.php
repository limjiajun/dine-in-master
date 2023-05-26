<?php


function randomOrderId()
{
    $limit = 10;
    $rand_num=rand(pow(10, $limit-1), pow(10, $limit)-1);
    $add_time=time().rand(99,10); 
    $final_unique_id=$rand_num.$add_time; 
    return $final_unique_id;
}
$order_id= randomOrderId();

if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $tbl_no = $_POST["tbl_no"];

    $sqltblno = "INSERT INTO `tbl_start`(`order_id`, `tbl_no`) VALUES ('$order_id', '$tbl_no')";

try{
    $result = $conn->query($sqltblno);
    echo "<script>
    window.location.href = 'customer_home.php?tbl_no=$tbl_no&order_id=$order_id';
    </script>";

} catch (PDOException $e){
    echo "<script>
    alert('Please enter again');
    </script>";
    echo "<script>
    window.location.replace('tblno.html');
    </script>";
}


}
?>