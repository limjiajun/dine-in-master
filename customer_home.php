<?php
include_once("dbconnect.php");
$tbl_no=$_GET['tbl_no'];
$order_id=$_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="nav.css">

    <style>
      button {  
        background-color:lightblue; 
        width: 300px; 
        height: 80px; 
        border: 5px solid darkblue; 
        font-size: 30px; 
        text-align: center; 
        margin: auto; 
      }  
    </style>
</head>

<body>

<div style="text-align:center;">
  <br><br><br><br><br><br><br><br><br><br><br>
  <button onclick="confirmOrder()">Order Now</button>
</div>
</body>
<script>
function confirmOrder() {
  if (confirm('Are you sure?')) {
    // Redirect to the desired URL
    window.location.href = 'customer_menulist.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>';
  } else {
    // Cancelled, do nothing
  }
}
</script>
</html>