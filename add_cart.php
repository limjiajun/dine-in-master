<?php
include_once("dbconnect.php");

if (isset($_POST["addCart2"])) {
    
    $tbl_no = $_GET['tbl_no'];
    $order_id=$_GET['order_id'];
    $menu_id = $_POST["menu_id"];
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $remark = $_POST["remark"];

    $sqlcheck = "SELECT * FROM `tbl_cart` WHERE (`tbl_no` = '$tbl_no' AND `menu_id` = '$menu_id')";

    $result = $conn->query($sqlcheck);

    if($result){
        if(mysqli_num_rows($result) > 0){
        $sqlupdate = "UPDATE `tbl_cart` SET `quantity` = (`quantity` + '$quantity') WHERE `tbl_no` = '$tbl_no' AND `menu_id` = '$menu_id'";

        try{
            $result1 = $conn->query($sqlupdate);
            echo "<script>
            alert('Add to Cart Successful');
            </script>";
            echo "<script>
            window.location.href = 'customer_menulist.php?tbl_no=$tbl_no&order_id=$order_id';
            </script>";
            
        } catch (PDOException $e){
            echo "<script>
            alert('Item Added Failed');
            </script>";
        }

        }else{
            $sqlinsert = "INSERT INTO `tbl_cart` (`order_id`, `tbl_no`, `menu_id`, `name`, `price`, `quantity`, `remark`) VALUES ('$order_id', '$tbl_no', '$menu_id', '$name', '$price', '$quantity', '$remark')";

            try{
                $result2 = $conn->query($sqlinsert);
                echo "<script>
                alert('Add to Cart Successful');
                </script>";
                echo "<script>
                window.location.href = 'customer_menulist.php?tbl_no=$tbl_no&order_id=$order_id';
                </script>";
                
            } catch (PDOException $e){
                echo "<script>
                alert('Item Added Failed');
                </script>";
            }
        }

    }
    
    
    
    

}
?>