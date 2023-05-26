<?php
include_once("dbconnect.php");
$tbl_no=$_GET['tbl_no'];
$order_id=$_GET['order_id'];

if (isset($_POST["decreaseQty"])) {

    $menu_id = $_POST["decreaseQty"];
   
    $sqldecrease = "UPDATE `tbl_cart` SET `quantity`= (quantity-1) WHERE `menu_id` = '$menu_id' AND `tbl_no` = '$tbl_no' AND `order_id` = '$order_id'";
    $sqlcheck = "SELECT * FROM `tbl_cart` WHERE `quantity` <1";
    $sqldelete = "DELETE FROM `tbl_cart` WHERE `quantity` <1";

    $result = $conn->query($sqlcheck);

    if(mysqli_num_rows($result) > 0){
        try{
            $conn->query($sqldelete);
            echo "<script>
            alert('Item Removed Successful');
            </script>";
            echo "<script>
            window.location.href = 'cart.php?tbl_no=$tbl_no&order_id=$order_id';
            </script>";
            
        } catch (PDOException $e){
            echo "<script>
            alert('Item Removed Failed');
            </script>";
        }
    }

    try{
        $conn->query($sqldecrease);
        echo "<script>
        alert('Quantity Updated Successful');
        </script>";
        echo "<script>
        window.location.href = 'cart.php?tbl_no=$tbl_no&order_id=$order_id';
        </script>";
        
    } catch (PDOException $e){
        echo "<script>
        alert('Quantity Updated Failed');
        </script>";
    }

    

}

if (isset($_POST["increaseQty"])) {

    $menu_id = $_POST["increaseQty"];
   
    $sqlincrease = "UPDATE `tbl_cart` SET `quantity`= (quantity+1) WHERE `menu_id` = '$menu_id' AND `tbl_no` = '$tbl_no' AND `order_id` = '$order_id'";

    try{
        $conn->query($sqlincrease);
        echo "<script>
        alert('Quantity Updated Successful');
        </script>";
        echo "<script>
        window.location.href = 'cart.php?tbl_no=$tbl_no&order_id=$order_id';
        </script>";
        
    } catch (PDOException $e){
        echo "<script>
        alert('Quantity Updated Failed');
        </script>";
    }

}

if (isset($_POST["removeCart"])) {
    
    $tbl_no = $_GET['tbl_no'];
    $menu_id = $_POST["removeCart"];
   
    
    $sqldelete = "DELETE FROM `tbl_cart` WHERE `menu_id` = '$menu_id' AND `tbl_no` = '$tbl_no' AND `order_id` = '$order_id'";

    try{
        $conn->query($sqldelete);
        echo "<script>
        alert('Item Removed Successful');
        </script>";
        echo "<script>
        window.location.href = 'cart.php?tbl_no=$tbl_no&order_id=$order_id';
        </script>";
        
    } catch (PDOException $e){
        echo "<script>
        alert('Item Removed Failed');
        </script>";
    }

}

?>