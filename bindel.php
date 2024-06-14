<?php

include 'config/config.php';
if(isset($_GET['bindel'])){
    $id = $_GET['bindel'];

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM `bin` WHERE id='$id'"; 
    $result = mysqli_query($conn, $sql);
    if($result){
        header("location:bin.php?msg=Data deleted successfully");
    } else {
        die(mysqli_error($conn));
    }
}

?>
