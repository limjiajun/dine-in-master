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
$menu_id=$_GET['menu_id'];
?>

<div class="topnav">
    <a href="manager_home.html">Home</a>
    <a href="manage_order.php">Manage Orders</a>
    <a class="active" href="manage_menu.php">Manage Menu</a>
    <a href="adminlogin.html" style="float:right">Logout</a>
  </div>

<?php
// Edit Record

    $sqlread = "SELECT * FROM tbl_menu WHERE menu_id=$menu_id";
    $result = $conn->query($sqlread);

  while ($row = mysqli_fetch_assoc($result)) {
    echo"<div style='width:80%; margin:auto; margin-top:50px; padding:20px; background-color: lightsteelblue;'>
    <h1 style='text-align: center;'>Edit Menu</h1><br>

    <div style='width:80%; margin:auto;'>";

      echo "<form method = 'POST' form action = 'update_menu.php' enctype='multipart/form-data'>
      <div class='mb-3'>
          <label class='form-label' for='menuid'>Menu ID</label><br>
          <input type='text' class='form-control' name='menuid' value='" . $row['menu_id'] . "' readonly=''>
        </div>

      <div class='form-outline mb-3'>
          <label class='form-label' for='image'>Image</label>
          <input type='file' name='image' id='image' class='form-control' required />
        </div>";
      
      echo "<div class='mb-3'>
      <label for='name' class='form-label'>Name</label>
      <input type='text' class='form-control' id='name' name='name' value='" . $row['name'] . "'>
    </div>";

      echo "<div class='mb-3'>
      <label for='category' class='form-label'>Category</label>
      <select class='form-control' name='category' id='category'>
        <option value='' disabled selected hidden>Please choose the category</option>
        <option value='Main course'>Main course</option>
        <option value='Desserts'>Desserts</option>
        <option value='Beverages'>Beverages</option>
      </select>
    </div>";

      echo "<div class='mb-3'>
      <label for='description' class='form-label'>Description</label>
      <input type='text' class='form-control' id='description' name='description' value='" . $row['description'] . "'>
    </div>";

      echo "<div class='mb-3'>
      <label for='price' class='form-label'>Price</label>
      <input type='text' class='form-control' id='price' name='price' value='" . $row['price'] . "'>
    </div>";

      echo "<tr><td colspan='2', style='text-align: center'><button type='submit' class='btn btn-primary' name='process_edit' value='" . $menu_id . "' >Save</button></td></tr>
      </table>
      <a href=manage_menu.php class='btn btn-dark'> Back </a>
      </form>
      </div></div>";
       
      
  }
  
