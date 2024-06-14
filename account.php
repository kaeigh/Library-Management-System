<?php
session_start();

@include 'config/config.php';

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);


   $select = " SELECT * FROM user_form WHERE name = '$name' && email = '$email'";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      header("location:addbook.php?msg=User already exist");
   } else {

      $insert = "INSERT INTO user_form(name,email,password,user_type) VALUES('$name','$email','$password','user_type')";
      mysqli_query($conn, $insert);
      header("location:account.php?msg=User created successfully");
   }
};


?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script defer src="js/script.js"></script>

    <title>Account page</title>
</head>

<body>

    <?php @include 'includes/header.php' ?>

    <?php
   if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="alert alert-warning alert-dismissible fade show"
    role="alert">
    '.$msg.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
   ?>

    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adduserModalLabel">Add Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="account.php">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User type</label>
                            <input type="text" class="form-control" name="user_type">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="container text-end my-3">
        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
            ADD USER
        </a>
        <a type="button" class="btn btn-danger" name="logout" href="logout.php">
            LOGOUT
        </a>

    </div>
    <?php
   if (isset($_SESSION['status'])) {
   ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
      unset($_SESSION['status']);
   }
      
   ?>
    <div class="col-sm-12 p-3">
        <table id="example" class="table table-sm table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>USER TYPE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>

                <?php

            $sql = "SELECT * FROM user_form";
            $result = mysqli_query($conn, $sql);
            if ($result) {
               while ($row = mysqli_fetch_assoc($result)) {
                  $user_id = $row['user_id'];
                  $name = $row['name'];
                  $email = $row['email'];
                  $password = sha1($row['password']);
                  $user_type = $row['user_type'];
                  echo '<tr>
                  <td>' . $name. '</td>
                  <td>' . $email. '</td>
                  <td>' . $password . '</td>
                  <td>' . $user_type . '</td>
                  <td>
               <button class="btn btn-success btn-sm"><a href="updateuser.php?editid='.$user_id.'" class="text-light">Update</a></button>
               <button class="btn btn-danger btn-sm"><a href="userdel.php?deleteid='.$user_id.'" class="text-light">Delete</a></button>
            </td>
                  </tr>';
               }
            }

            ?>

</body>

</html>
