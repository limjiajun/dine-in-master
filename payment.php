<?php

$tbl_no=$_GET['tbl_no'];
$order_id=$_GET['order_id'];
$total_price = $_GET['total_price']; 


$api_key = '4a24bc62-d490-4160-a85b-ac340575d0a4';
$collection_id = 'pqbij3zm';
 
$host = 'https://www.billplz-sandbox.com/api/v3/bills';


$data = array(
          'collection_id' => $collection_id,
          'email' => 'uum@gmail.com',
          'name' => '-',
          'amount' => $total_price * 100, // RM20
		  'description' => 'Payment for order by table no.:'.$tbl_no,
          'callback_url' => "https://moneymoney12345.com/278723/DineInOrderingPaymentSystem/return_url",
          'redirect_url' => "https://moneymoney12345.com/278723/DineInOrderingPaymentSystem/payment_update.php?tbl_no=$tbl_no&order_id=$order_id&total_price=$total_price" 
);


$process = curl_init($host );
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data) ); 

$return = curl_exec($process);
curl_close($process);

$bill = json_decode($return, true);
header("Location: {$bill['url']}");
?>