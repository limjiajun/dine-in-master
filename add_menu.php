<?php
include_once("dbconnect.php");

if (isset($_POST["add"])) {
    
    $image=addslashes (file_get_contents($_FILES['image']['tmp_name']));
    $name = $_POST["name"];
    $category = $_POST["category"];
    $description =$_POST["description"];
    $price = $_POST["price"];
   
    
    $sqlinsert = "INSERT INTO `tbl_menu` (`image`, `name`, `category`, `description`, `price`) VALUES ('$image', '$name', '$category', '$description', '$price')";

    try{
        $result = $conn->query($sqlinsert);
        echo "<script>
        alert('Menu Added Successful');
        </script>";
        echo "<script>
        window.location.href = 'manage_menu.php';
        </script>";
        
    } catch (PDOException $e){
        echo "<script>
        alert('Menu Added Failed');
        </script>";
    }

}
?>