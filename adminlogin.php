<?php

if (isset($_POST["login"])){
    include 'dbconnect.php';
    $manager_id = $_POST['manager_id'];
    $password = ($_POST['password']);
    $sqllogin = "SELECT * FROM tbl_manager WHERE `manager_id` = '$manager_id' AND `password` = '$password'";
    $result = $conn->query($sqllogin);
    $number_of_rows = $result->fetch_assoc();
    
    
    if($number_of_rows > 0){
      
        echo "<script>alert('Login Success');</script>";
        echo "<script>
        window.location.href = 'manager_home.html';
        </script>";
  
    } else{
        echo "<script>alert('Login Failed');</script>";
        echo "<script>
        window.location.href = 'adminlogin.html';
        </script>";

    }

}

?>