<?php

include 'config/config.php';
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM `book` WHERE id='$id'"; 
    $result = mysqli_query($conn, $sql);
    if($result){
        header("location:admin_page.php?msg=Data deleted successfully");
    } else {
        die(mysqli_error($conn));
    }
}

?>
