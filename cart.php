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
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    body{
    margin-top:20px;
    background:#eee;
    }
    .ui-w-40 {
        width: 40px !important;
        height: auto;
    }

    .card{
        box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
    }

    .ui-product-color {
        display: inline-block;
        overflow: hidden;
        margin: .144em;
        width: .875rem;
        height: .875rem;
        border-radius: 10rem;
        -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
        vertical-align: middle;
    }
    </style>
</head>
<body>
  <form method="post" action="update_remove_cart.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>">
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered m-0">
                    <thead>
                      <tr>
                        <!-- Set columns width -->
                        <th class="text-center py-3 px-4" style="min-width: 100px;">Image</th>
                        <th class="text-center py-3 px-4" style="min-width: 400px;">Name</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                        <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                        <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                      $sqlread = "SELECT * FROM tbl_cart INNER JOIN tbl_menu ON tbl_cart.menu_id = tbl_menu.menu_id WHERE tbl_no = $tbl_no AND order_id = $order_id";
                      $result = $conn->query($sqlread);
                      $total_price = 0;
                          
                      while ($row = mysqli_fetch_assoc($result)) {
                        $item_total = $row['quantity'] * $row['price'];
                        $total_price = $total_price + $item_total;
                    ?>

                      <tr>
                        <td class="p-4">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']);?>" style="width:100px; height:100px;" alt="">
                        </td>

                        <td><?php echo $row['menu_id'];?> <?php echo" ";?> <?php echo $row['name'];?></td>

                        <td class="text-right font-weight-semibold align-middle p-4">RM <?php echo $row['price'];?></td>

                        <td class="align-middle p-4">
                          <div>
                            <button name="decreaseQty" id="decreaseQty" type="submit" value ="<?php echo $row['menu_id'];?>" onclick="decreaseOne(<?php echo $row['menu_id'];?>)">-</button>
                            <input name="qty" id="qty" type="text" class="form-control text-center" value="<?php echo $row['quantity'];?>" min="1">
                            <button name="increaseQty" id="increaseQty" type="submit" value ="<?php echo $row['menu_id'];?>" onclick="increaseOne(<?php echo $row['menu_id'];?>)">+</button>
                          </div>
                        </td>

                        <td class="text-right font-weight-semibold align-middle p-4">RM <?php echo $item_total;?></td>

                        <td class="text-center align-middle px-0"><button class="btn btn-danger" name="removeCart" type="submit" value ="<?php echo $row['menu_id'];?>">×</button></td>
                      </tr>

                      <?php
                        }
                      ?>

                    </tbody>
                  </table>
                </div>
  </form>

<!-- / Shopping cart table -->
<form method="post" action="payment.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>&total_price=<?php echo $total_price; ?>">
  <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
    <div class="d-flex">
      <div class="text-right mt-4">
        <label class="text-muted font-weight-normal m-0" style="font-size:20px;">Total price</label>
        <div class="text-large" style="font-size:40px;"><strong>RM <?php echo $total_price;?></strong></div>
      </div>
    </div>
  </div>

  <div style="float: right;">
    <a href="customer_menulist.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>"><button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to menu</button></a>
    <a href="COD.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>&total_price=<?php echo $total_price; ?>">
    <button type="button" class="btn btn-lg btn-primary mt-2">COD</button>
</a>

    <button name="checkout" type="submit" value ="<?php echo $total_price;?>" class="btn btn-lg btn-primary mt-2">Checkout</button>
  </div>
</form>




</body>
</html>

<script>
  function increaseOne(menu_id) {
    document.getElementById("qty").stepUp(1);
  }

  function dncreaseOne(menu_id) {
    document.getElementById("qty").stepDown(1);
  }
    
</script>