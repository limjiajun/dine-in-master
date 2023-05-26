<?php
print "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'
integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>";
echo '
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>';

error_reporting(0);
include_once("dbconnect.php");
$tbl_no=$_GET['tbl_no'];
$order_id=$_GET['order_id'];
$total_price = $_GET['total_price']; 

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus=="true"){
    $paidstatus = "Success";
    $status = "Paid";
}else{
    $paidstatus = "Failed";
    $status = "Failed";
}
$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}
 
 
$signed= hash_hmac('sha256', $signing, 'S-0qDxDvcSDJUebj0t55u84w');
if ($signed === $data['x_signature']) {
    if ($paidstatus == "Success"){ //payment success
        $sqlinsertpayment = "INSERT INTO `tbl_order` (`order_id`, `tbl_no`, `menu_id`, `name`, `price`, `quantity`, `remark`)
                                SELECT `order_id`, `tbl_no`, `menu_id`, `name`, `price`, `quantity`, `remark`
                                FROM `tbl_cart`
                                WHERE `tbl_no`='$tbl_no' AND `order_id`='$order_id'";
        $sqlupdateorder = "UPDATE `tbl_order` SET `receipt_id`='$receiptid',`totalprice`='$total_price',`waiter_status`='Active',`kitchen_status`='Active' WHERE `tbl_no` = $tbl_no AND `order_id` = $order_id";
        $sqldeletecart = "DELETE FROM `tbl_cart` WHERE `tbl_no` = $tbl_no AND `order_id` = $order_id";
        $sqldeletetbl = "DELETE FROM `tbl_start` WHERE `tbl_no` = $tbl_no AND `order_id` = $order_id";

        try{
            $conn->query($sqlinsertpayment);
            $conn->query($sqldeletecart);
            $conn->query($sqldeletetbl);
            
            $result = $conn->query($sqlupdateorder);
            $message = "Payment completed.";
            $total_price = number_format((float)$total_price, 2, '.', '');
            printTable1($receiptid,$order_id,$tbl_no,$total_price,$paidstatus,$message); 
            
            
        } catch (PDOException $e){
            $message = "Payment incompleted. Please perform the payment again.";
            printTable2('Failed',$order_id,$tbl_no,$total_price,$paidstatus,$message);
        }
    }else{
        $message = "Payment incompleted. Return back to the application by pressing the back button on the app task bar and perform the payment again.";
        printTable2('Failed',$order_id,$tbl_no,$total_price,$paidstatus,$message);
    }
}

function printTable1($receiptid,$order_id,$tbl_no,$total_price,$paidstatus,$message){
   echo "
        <html>
        <head>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
        </head>
        <div = class='w3-padding'> <h4>Thank you for your payment</h4>
        <p>The following is your receipt</p></div>
        <div class='w3-container w3-padding'>
            <table class='w3-table w3-striped w3-bordered'>
            <tr><th>Receipt ID</th><td>$receiptid<td></tr>
            <tr><th>Order ID</th><td>$order_id<td></tr>
            <tr><th>Paid By Table</th><td>$tbl_no<td></tr>
            <tr><th>Amount </th><td>RM $total_price<td></tr>
            <tr><th>Payment Status</th><td>$paidstatus<td></tr>
            </table>
        <hr>
        <div class='w3-container w3-round w3-block w3-green'>$message</div>
        </div>
        <div style='text-align:center;'>
        <a href='tbl_no.html'><button name='home' type='submit' class='btn btn-lg btn-primary mt-2'>Back to Home</button></a>
        </div>

        </body></html> 
        ";
}

function printTable2($receiptid,$order_id,$tbl_no,$total_price,$paidstatus,$message){
    echo "
         <html>
         <head>
             <meta name='viewport' content='width=device-width, initial-scale=1'>
             <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
         </head>
         <div = class='w3-padding'> <h4>Thank you for your payment</h4>
         <p>The following is your receipt</p></div>
         <div class='w3-container w3-padding'>
             <table class='w3-table w3-striped w3-bordered'>
             <tr><th>Receipt ID</th><td>$receiptid<td></tr>
             <tr><th>Order ID</th><td>$order_id<td></tr>
             <tr><th>Paid By Table</th><td>$tbl_no<td></tr>
             <tr><th>Amount </th><td>RM $total_price<td></tr>
             <tr><th>Payment Status</th><td>$paidstatus<td></tr>
             </table>
         <hr>
         <div class='w3-container w3-round w3-block w3-green'>$message</div>
         </div>
         <div style='text-align:center;'>
         <a href='cart.php?order_id=".$order_id."&tbl_no=".$tbl_no."'<button name='cart' type='submit' class='btn btn-lg btn-primary mt-2'>Back to Cart</button></a>
         </div>
 
         </body></html> 
         ";
 }

?>