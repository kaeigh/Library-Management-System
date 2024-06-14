<?php
session_start();

@include 'config/config.php';

if (isset($_POST['adduser'])) {

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
   <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
   <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
   <script defer src="js/script.js"></script>
   <link rel="stylesheet" href="css/styling.css">


   <title>admin db</title>
</head>

<body>

<?php @include 'includes/header.php' ?>

   <div class="form-container">
      <!-- <div class="col-md-12"> -->
         <div class="card">
            <div class="card-header">
               <h4>
                  Add user
                  <a href="account.php" class="btn btn-primary float-end">Back</a>
               </h4>
            </div>
            <div class="card-body">
   <form method="POST">
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" autocomplete="off">
                     </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>User type</label>
                        <input type="text" name="usertype" class="form-control" autocomplete="off" placeholder="user or admin">
                     </div>
                  </div>
                  <hr>
                  <div class="col-md-12">
                     <div class="mb-3 text-end">
                        <button type="submit" name="adduser" class="btn btn-primary">Save</button>
                     </div>
                  </div>


               </form>

</body>

</html>
