<?php
print "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'
integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
<link rel='stylesheet' href='css/design.css'>";
echo '
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>';

include_once("dbconnect.php");

// Update Data
if (isset($_POST["process_edit"])) {

    $menu_id = $_POST["process_edit"];
    $image=addslashes (file_get_contents($_FILES['image']['tmp_name']));
    $name = $_POST['name'];
    $category = $_POST["category"];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sqlupdate = "UPDATE tbl_menu SET menu_id ='$menu_id',  `image` ='$image', `name` ='$name', `category` = '$category', `description` ='$description', `price` ='$price' where menu_id='$menu_id' ";


    if ($conn->query($sqlupdate) === TRUE) {
        ?>
   <script type="text/javascript">
                    alert("Menu Updated Successfully");
                    window.location.href = "manage_menu.php";
    </script>

<?php
    }

}

?>