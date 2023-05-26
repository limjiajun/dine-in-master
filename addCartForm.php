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
$tbl_no=$_GET['tbl_no'];
$order_id=$_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cart</title>
</head>
<body>
    <div class="topnav">
        <a href="customer_menulist.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>">Menu</a>
    </div>

    <?php
        if (isset($_POST["addCart"])) {
        $sqlread = "SELECT * FROM tbl_menu WHERE menu_id=" .$_POST["addCart"];
        $result = $conn->query($sqlread);
  
        while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div style="width: 80%; margin:auto; margin-top:50px; padding:20px; background-color: lightsteelblue;">

    <form method="post" action="add_cart.php?tbl_no=<?php echo $tbl_no; ?>&order_id=<?php echo $order_id; ?>">
    <div style="width:80%; margin:auto">

      <div class="mb-3">
        <label for="menu_id" class="form-label">Menu ID</label>
        <input type="text" class="form-control" name="menu_id" value="<?php echo $row['menu_id'];?>" id="menu_id" aria-describedby="textHelp" readonly>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" id="name" aria-describedby="textHelp" readonly>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" value="RM <?php echo $row['price'];?>" id="price" aria-describedby="textHelp" readonly>
      </div>

      <div class="mb-3">
        <label for="day" class="form-label">Quantity</label>
		<input type="number" name="quantity" class="input" value="1" min="1" />
      </div>

      <div class="mb-3">
        <label for="remark" class="form-label">Remark</label>
        <input type="text" class="form-control" name="remark" id="remark" aria-describedby="textHelp">
      </div>

      <div style="text-align:center;">
        <button name="addCart2" type="submit" class="btn btn-primary" value ='".$_POST["addCart2"]."'>Add to Cart</button>
      </div>
    </form>
  </div>
  </div>

  <?php
        }
    }
  ?>
    
</body>
</html>