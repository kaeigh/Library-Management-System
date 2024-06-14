<?php
session_start();

@include 'config/config.php';

 
if (isset($_POST['return'])) {
 
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $select = " SELECT * FROM returns WHERE isbn = '$isbn' && name = '$name'";
 
    $result = mysqli_query($conn, $select);
 
    if (mysqli_num_rows($result) > 0) {
        header("location:qr_code_return.php?msg=Book is already returned");
    } else {
        $insert = "INSERT INTO returning(isbn,name) VALUES('$isbn','$name')";
        mysqli_query($conn, $insert);
        header("location:qr_code_return.php?msg=Return successfully");
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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <title>qr code return</title>
</head>

<body>

<?php @include 'includes/header.php' ?>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="qr-container">
                    <h5 class="text-center">Scan QR Code to return</h5>
                    <video id="scanner" class="viewport" width="100%"></video>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <form method="post">
                    <div class="header-text">
                        <h4>Input book info</h4>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label mb-0">International Standard Book Address</label>
                        <input type="text" class="form-control form-control-sm" name="isbn" id="isbn"
                            autocomplete="off" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label mb-0">Location</label>
                        <input type="text" class="form-control form-control-sm" name="location" id="location"
                            autocomplete="off" readonly>
                    </div>
                    <hr>
                    <div class="header-text">
                        <h4>Input borrower info</h4>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label mb-0">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name"
                            autocomplete="off" readonly>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>

    <?php
if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>

    <div class="container-fluid row header-text">
        <h4>Returned books</h4>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="container-fluid box-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <th>ISBN</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Returned date</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php
                        $sql = "SELECT * FROM `returns`";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $isbn = $row['isbn'];
                                $name = $row['name'];
                                $location = $row['location'];
                                $returned_date = $row['returned_date'];
                                $status = $row['status'];
                                echo '<tr>
                                        <td>' . $isbn . '</td>
                                        <td>' . $name . '</td>
                                        <td>' . $location . '</td>
                                        <td>' . $returned_date . '</td>
                                        <td>' . $status. '</td>
                                    </tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Scanner -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Instascan Js -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
    let scanner;

    function startScanner() {
        scanner = new Instascan.Scanner({
            video: document.getElementById('scanner')
        });

        scanner.addListener('scan', function(content) {
            // Fill the input field with the scanned ISBN
            $("#isbn").val(content);
            scanner.stop();
        });

        Instascan.Camera.getCameras()
            .then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            })
            .catch(function(err) {
                console.error('Camera access error:', err);
                alert('Camera access error: ' + err);
            });
    }

    document.addEventListener('DOMContentLoaded', startScanner);
    </script>

<br>
<br>
<br>

</body>

</html>

<?php @include 'includes/footer.php' ?>