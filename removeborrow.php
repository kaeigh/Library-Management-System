<?php

include 'config/config.php';
if(isset($_GET['removeid'])){
    $id = $_GET['removeid'];

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM `borrow` WHERE id='$id'"; 
    $result = mysqli_query($conn, $sql);
    if($result){
        header("location:qr_code_borrow.php");
    } else {
        die(mysqli_error($conn));
    }
}

?>
