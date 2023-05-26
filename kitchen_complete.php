<?php
print "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'
integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
<link rel='stylesheet' href='nav.css'>
<link rel='stylesheet' href='print.css' type='text/css' media='print'>";
echo '
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>';

include_once("dbconnect.php");
$order_id=$_GET['order_id'];
$tbl_no=$_GET['tbl_no'];
$sql = "UPDATE `tbl_order` SET `kitchen_status`='Completed' WHERE `order_id` = '$order_id'";

try{
    $result = $conn->query($sql);
    echo "<div style='text-align: center;'>";
    echo "<h3>Order ID: ".$order_id."</h3>";
    echo "<h3>Table No.: ".$tbl_no."</h3>";
?>

    <button id="printbtn" onclick="window.print();" class="btn btn-primary">Print</button>
    <a href = "kitchenpage.php"><button id="homebtn" class='btn btn-success'>Back to Home</button></a>
    </div>

<?php
    echo "<script>
    alert('Order Completed');
    </script>";
    
} catch (PDOException $e){
    echo "<script>
    alert('Order Fail to Complete');
    </script>";
}
?>