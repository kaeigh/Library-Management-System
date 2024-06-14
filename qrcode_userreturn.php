<?php
session_start();

@include 'config/config.php';
$id = $_GET['returnid'];


if (isset($_POST['return'])) {


    $sql = "select * from `borrow` where id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $isbn = $row['isbn'];
    $title = $row['name'];

    $isbn = $_POST['isbn'];
    $title = $_POST['name'];

    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $insert = "insert into `returning`(isbn,name) VALUES('$isbn','$name')";
    mysqli_query($conn, $insert);

    $result = mysqli_query($conn, $sql);

    if ($result) {

        header("location: qrcode_userborrow.php?msg=Book return successfully!");
    } else {
        die(mysqli_error($conn));
    }

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM `borrow` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location:qrcode_userborrow.php");
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
    <!-- <script defer src="js/return.js"></script> -->

    <title>qr code return</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="user_page.php" style="color: crimson">LMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="user_page.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="qrcode_userborrow.php" style="color: crimson">QRcode scanner</a>
                    </li>
                </ul>
                <a href="logout.php"><i class="fa-solid fa-power-off" style="color: crimson"></i></a>
            </div>
        </div>
    </nav>

    <div class="text-center my-2">
        <a href="qrcode_userborrow.php" class="btn btn-outline-danger">BORROW</a>
        <button type="submit" class="btn btn-outline-danger active">RETURN</button>
    </div>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="text-light col-lg-6 col-md-12">*camera/scanner goes here</div>


            <div class="col-lg-6 col-md-12">

                <?php


                $sql = "SELECT * FROM `borrow` WHERE id = '$id' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                ?>


                <form method="post" name="theform">
                    <div class="text-light header-text">
                        <h4>Book info</h4>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="text-light form-label mb-0">International Standard Book Address</label>
                        <input type="text" class="form-control form-control-sm" name="isbn" id="isbn" required autocomplete="off" onkeyup="checkform()" value="<?php echo $row['isbn'] ?>">
                    </div>
                    <hr>
                    <div class="text-light header-text">
                        <h4>Borrower info</h4>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="text-light form-label mb-0">Name</label>
                        <input type="name" class="form-control form-control-sm" id="name" name="name" required autocomplete="off" onkeyup="checkform()" value="<?php echo $row['name'] ?>">
                    </div>


                    <button type="submit" class="btn btn-danger" name="return" id="form-btn">Return</button>
                </form>


            </div>
        </div>
    </div>


    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show"
    role="alert">
    ' . $msg . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>



    <div class="text-light row header-text">
        <h4>Borrowed books</h4>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>Status</th>

                        </thead>
                        <tbody>

                        </tbody>

                        <?php

                        $sql = "select * from `returning`";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $isbn = $row['isbn'];
                                $name = $row['name'];
                                $status = $row['status'];
                                echo '<tr>
                                <td>' . $isbn . '</td>
                                <td>' . $name . '</td>
                                <td>' . $status . '</td>
                                </tr>';
                            }
                        }

                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>




</body>

</html>

<?php @include 'includes/footer.php' ?>