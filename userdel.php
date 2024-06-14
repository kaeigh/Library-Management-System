<?php

include 'config/config.php';
if(isset($_GET['deleteid'])){
    $user_id=$_GET['deleteid'];

    $sql="delete from `user_form` where user_id='$user_id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        header("location:account.php?msg=User deleted successfully");
    }else{
        die(mysqli_error($conn));
    }
}


?>