<?php
session_start();

@include 'config/config.php';
$user_id = $_GET['editid'];

if (isset($_POST['save'])) {

    $sql = "select * from `user_form` where user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $pass = $row['password'];
    $user_type = $row['user_type'];



    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user_type = $_POST['user_type'];


    $sql = "UPDATE `user_form` SET `name`='$name',`email`='$email',`password`='$pass',`user_type`='$user_type' WHERE `user_id`='$user_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        header("location: account.php?msg=User updated successfully");
    } else {
        die(mysqli_error($conn));
    }
}

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


<div class="form-container ">
        <!-- <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit user
                    <a href="account.php" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?php


                $sql = "SELECT * FROM `user_form` WHERE user_id = '$user_id' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                ?>

                <form method="POST">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo $row['name'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $row['email'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" autocomplete="off" value="<?php echo $row['password'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>User type</label>
                            <input type="text" name="user_type" class="form-control" autocomplete="off" value="<?php echo $row['user_type'] ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="mb-3 text-end">
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                </form>
            </div>
            <!-- </div>
      </div> -->
        </div>

</body>

</html>

