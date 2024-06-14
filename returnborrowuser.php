<?php

include 'config/config.php';
if(isset($_GET['returnid'])){
    $id=$_GET['returnid'];

    $sql="delete from `borrow` where id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        header("location:qrcode_userborrow.php?msg=Book successfully returned!");
    }else{
        die(mysqli_error($conn));
    }
}


?>