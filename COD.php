<?php
    if(isset($_GET['tbl_no']) && isset($_GET['order_id']) && isset($_GET['total_price'])){
        $tbl_no = $_GET['tbl_no'];
        $order_id = $_GET['order_id'];
        $total_price = $_GET['total_price'];
    } else {
        // Handle the case where the GET parameters are not set
        // Redirect the user or display an error message
        echo "Error: Missing parameters.";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    
    <title>Order Confirmation</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
</head>
<body>
    <div class="card">
        <?php if ($total_price == 0): ?>
            <i class="checkmark">X</i>
            <h1>Order Failed</h1> 
        <?php else: ?>
            <i class="checkmark">✓</i>
            <h1>Order Successful!</h1> 
            <p>Thank you for your order!</p>
            <p>Please proceed to our counter to complete your payment.</p>
            <p>We're looking forward to serving you.</p>
            <p>Enjoy your meal and the ambiance at our restaurant. We appreciate your patronage!</p>
        <?php endif; ?>
        <p>We received your order with the following details:</p>
        <p>Order ID: <?php echo $order_id; ?></p>
        <p>Paid By Table: <?php echo $tbl_no; ?></p>
        <p>Total Amount: RM<?php echo $total_price; ?></p>
        
        <a href="customer_menulist.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>"><button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3" style="background-color: blue; color: white;">Back to menu</button></a>
    </div>
    <footer>
        <p>Contact us at: 123-456-7890</p>
        <p>Operating hours: 9AM - 10PM</p>
    </footer>
</body>
</html>
