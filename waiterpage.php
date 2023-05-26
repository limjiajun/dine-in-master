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
    
    <div style="width:90%; margin:auto; margin-top:50px; padding:20px; background-color: lightsteelblue;">
    <table class= "table table-bordered " style='margin-left: auto;margin-right: auto;'>
  <form>
    <div>
    <p style="text-align:left">Waiter Site</p>
    <h1 style="text-align:center">Order List</h1>
    </div>
    <thead>
    <tr class = "table-primary">
        <th>Order ID</th>
        <th>Table No.</th>
        <th>Total Price</th>
        <th>Kitchen Status</th>
        <th>Waiter Status</th>
        <th></th>
        <th></th>
    </tr>
    </thead>

    <tbody>

    <?php
        $result_per_page = 8;
        if(isset($_GET['pageno'])){
            $pageno = (int)$_GET['pageno'];
            $page_first_result = ($pageno - 1) * $result_per_page;
        }else{
            $pageno = 1;
            $page_first_result = 0;
        }


        $filter = "SELECT * FROM `tbl_order` GROUP BY `order_id`";

        $stmt = $conn->prepare($filter);
        $stmt->execute();
        $number_of_results = $stmt->rowCount();
        $number_of_page = ceil($number_of_results/$result_per_page);
        $filter = $filter . " LIMIT $page_first_result , $result_per_page";
        $stmt = $conn->prepare($filter); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchAll();
    ?>

    <?php
    if ($number_of_results > 0) {
        $i = 0;
        foreach ($row as $test) {
            $i += 1;
            if ($i == 11) {
                break;
            }

            $order_id = $test['order_id'];
            $tbl_no = $test["tbl_no"];
            $totalprice = $test["totalprice"];
            $kitchen_status = $test["kitchen_status"];
            $waiter_status = $test["waiter_status"];


            echo "<td> $order_id </td>";
            echo "<td > $tbl_no </td>";
            echo "<td > $totalprice </td>";
            echo "<td > $kitchen_status </td>";
            echo "<td > $waiter_status </td>";
            ?>
            
            <td ><a href = "waiter_view_order.php?order_id=<?php echo $order_id; ?>&tbl_no=<?php echo $tbl_no; ?>" class='btn btn-outline-primary btn-sm'>View Details</a></td>
            <td ><a href = "waiter_complete.php?order_id=<?php echo $order_id; ?>" class='btn btn-outline-danger btn-sm'onclick=' return confirm("Are you sure you want to complete this order? \n Order ID = <?php echo $order_id; ?>")'>Complete Order</a></td>
            
            <?php
            echo "</tr>";

        }
        }else if ($number_of_results == 0) {
            echo '<script language="javascript">
            alert("No Record Found")
            window.location.href="waiterpage.php"
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
        echo '<a href = "waiterpage.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
<br>

<div id = "disp_btn">
    <a href = "waiterpage.php" class="btn btn-secondary">Display All</a>
</div>



    </div>