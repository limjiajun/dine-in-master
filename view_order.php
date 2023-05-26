<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>

<?php
print "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'
integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
<link rel='stylesheet' href='design.css'>
<link rel='stylesheet' href='nav.css'>";
echo '
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>';

include_once("dbconnect.php");
?>

<div class="topnav">
    <a href="manager_home.html">Home</a>
    <a class="active" href="manage_order.php">Manage Orders</a>
    <a href="manage_menu.php">Manage Menu</a>
    <a href="adminlogin.html" style="float:right">Logout</a>
</div>

<?php
// View Details
    $order_id=$_GET['order_id'];
    $sqlread = "SELECT * FROM tbl_order INNER JOIN tbl_menu ON tbl_order.menu_id = tbl_menu.menu_id WHERE order_id = $order_id";
    $result = $conn->query($sqlread);
    $totalprice = 0;

    echo"<div style='width:80%; margin:auto; margin-top:50px; padding:20px; background-color: lightsteelblue;'>
    <h1 style='text-align: center;'>Order Details</h1>
    <strong><p style='text-align: center;'>Order ID: "; echo $order_id; echo "</p></strong>;

    <div style='width:80%; margin:auto;'>";

      echo "<form>

      <div class='table-responsive'>
        <table class='table table-bordered m-0'>
          <thead>
            <tr class = 'table-primary'>
                <th>Menu ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Remark</th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>";

  while ($row = mysqli_fetch_assoc($result)) {
    $item_total = $row['quantity'] * $row['price'];
    $totalprice = $totalprice + $item_total;

    echo
    "<tr>
    <td>".$row['menu_id']."</td>
    
    <td>".$row['name']."</td>

    <td class='text-right font-weight-semibold align-middle p-4'>". $row['price']."</td>

    <td class='align-middle p-4'>" .$row['quantity']."</td>

    <td class='align-middle p-4'>" .$row['remark']."</td>

    <td class='text-right font-weight-semibold align-middle p-4'>RM ".$item_total."</td>

    </tr>"
    ;
       
      
  }

  echo "</tbody>
  </table>
  </div>

  <div class='d-flex flex-wrap justify-content-between align-items-center pb-4'>
    <div class='d-flex'>
      <div class='text-right mt-4'>
        <label class='text-muted font-weight-normal m-0' style='font-size:20px;'>Total price</label>
        <div class='text-large' style='font-size:40px;'><strong>RM ".$totalprice. "</strong></div>
      </div>
    </div>
  </div>
      
  <a href=manage_order.php class='btn btn-dark'> Back </a>
  </form>
  </div></div>";

?>

</body>
</html>