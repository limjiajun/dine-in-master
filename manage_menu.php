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

<!-- Display list -->
<div class="topnav">
    <a href="manager_home.html">Home</a>
    <a href="manage_order.php">Manage Orders</a>
    <a class="active" href="manage_menu.php">Manage Menu</a>
    <a href="adminlogin.html" style="float:right">Logout</a>
</div>
    
    <div style="width:90%; margin:auto; margin-top:50px; padding:20px; background-color: lightsteelblue;">

    <button style="background-color:lightblue; width: 150px; height: 50px; border: 5px solid darkblue; font-size: 20px; text-align: center; margin: auto; float:right; font-weight:bold;" 
      onclick = "window.location.href='add_menu.html';">Add Menu</button>

    <table class= "table table-bordered " style='margin-left: auto;margin-right: auto;'>
  <form>
    <div>
    <h1 style="text-align:center">Menu List</h1>
</div>
    <thead>
        <tr class = "table-primary">
            <th>Menu ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    <?php
    
        $result_per_page = 3;
        if(isset($_GET['pageno'])){
            $pageno = (int)$_GET['pageno'];
            $page_first_result = ($pageno - 1) * $result_per_page;
        }else{
            $pageno = 1;
            $page_first_result = 0;
        }

        
        $filter = "SELECT COUNT(*) as count FROM tbl_menu";
        $result = $conn->query($filter);
        $row = $result->fetch_assoc();
        $number_of_results = $row['count'];
        
        $number_of_page = ceil($number_of_results / $result_per_page);
        
        $filter = "SELECT * FROM tbl_menu LIMIT $page_first_result, $result_per_page";
        $result = $conn->query($filter);
        $row = $result->fetch_all(MYSQLI_ASSOC);

        

    ?>

    <?php
    if ($number_of_results > 0) {
        $i = 0;
        foreach ($row as $test) {
            $i += 1;
            if ($i == 11) {
                break;
            }

            $menu_id = $test['menu_id'];
            $name = $test["name"];
            $category = $test["category"];
            $description = $test["description"];
            $price = $test["price"];

            echo "<td> $menu_id </td>";
            echo "<td > <img src='data:image/jpeg;base64,".base64_encode( $test["image"] )."'
            style='object-fit:contain;
                        width:100px;
                        height:100px;
                        border: solid 1px #CCC'/> </td>";
            echo "<td > $name </td>";
            echo "<td > $category </td>";
            echo "<td > $description </td>";
            echo "<td > $price </td>";
            ?>
            
            <td ><a href = "edit_menu.php?menu_id=<?php echo $menu_id; ?>" class='btn btn-outline-primary btn-sm'>Edit</a></td>
            <td ><a href = "delete_menu.php?menu_id=<?php echo $menu_id; ?>" class='btn btn-outline-danger btn-sm'onclick=' return confirm("Are you sure you want to delete this menu? \n Menu ID = <?php echo $menu_id; ?>")'>Delete</a></td>
            
            <?php
            echo "</tr>";

        }
        }else if ($number_of_results == 0) {
            echo '<script language="javascript">
            alert("No Record Found")
            window.location.href="manage_menu.php"
            </script>';
        }
    ?>
    </tbody>
</form>
</table>
    <br>
        <?php
        $num = 1;
        if ($pageno == 1) {
            $num = 1;
        } else if ($pageno == 2) {
            $num = ($num) + 10;
        } else {
            $num = $pageno * 10 - 9;
        }
        echo "<div class='w3-container w3-row' style='background-color: primaryblue; width: 80%; margin: auto'>";
        echo "<center>";
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a href = "manage_menu.php?pageno=' . $page . '" style=
                "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
        }
        echo " ( " . $pageno . " )";
        echo "</center>";
        echo "</div>";
        ?>
    <br>

    <div id = "disp_btn">
        <a href = "manage_menu.php" class="btn btn-secondary">Display All</a>
    </div>
</div>