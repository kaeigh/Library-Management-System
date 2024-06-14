<?php
session_start();
@include 'config/config.php';

if (isset($_POST['borrow'])) {
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = $_POST['location'];

    // Check if the ISBN already exists in the borrow table
    $select = "SELECT * FROM borrow WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        // ISBN already exists, redirect with a message
        header("location:qr_code_borrow.php?msg=Book is already borrowed");
    } else {
        // ISBN does not exist, insert it into the borrow table
        $insert = "INSERT INTO borrow(isbn, name,location) VALUES('$isbn','$name','$location')";
        mysqli_query($conn, $insert);
        // Redirect with a success message
        header("location:qr_code_borrow.php?msg=Borrow successfully");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>qr code borrow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script defer src="js/script.js"></script>
</head>

<body>
    <?php @include 'includes/header.php' ?>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="attendance-container row">
                <div class="qr-container col-lg-6 col-md-12">
                    <div class="scanner-con">
                        <h5 class="text-center">Scan your QR Code here </h5>
                        <video id="interactive" class="viewport" width="100%"></video>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="container">
                        <h4 class="header-text">Input book info</h4>
                        <form id="borrowForm" method="post">
                            <div class="mb-3">
                                <label for="isbn" class="form-label">International Standard Book Address</label>
                                <input type="text" class="form-control form-control-sm" name="isbn" id="isbnInput"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control form-control-sm" name="location" id="locationInput"
                                    autocomplete="off">
                            </div>
                            
                            <hr>
                            <h4 class="header-text">Input borrower info</h4>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name"
                                    autocomplete="off">
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary" name="borrow">Borrow</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        ?>
        <div class="container-fluid row header-text">
            <h4>Borrowed books</h4>
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
                                <th>Borrowed date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM borrow";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $isbn = $row['isbn'];
                                        $name = $row['name'];
                                        $location = $row['location'];
                                        $borrowed_date = $row['borrowed_date'];
                                        $status = $row['status'];
                                        echo '<tr>
                                                <td>' . $isbn . '</td>
                                                <td>' . $name . '</td>
                                                <td>' . $location . '</td>
                                                <td>' . $borrowed_date . '</td>
                                                <td>' . $status . '</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"><a href="qrcode_returnup.php?returnid=' . $id . '" class="text-light">Return</a></button>
                                                </td>
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- instascan Js -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>
    let scanner;

    function startScanner() {
        scanner = new Instascan.Scanner({
            video: document.getElementById('interactive')
        });

        scanner.addListener('scan', function(content) {
            // Split the content of the scanned QR code into ISBN and location
            const parts = content.split(', ');
            if (parts.length === 2) {
                const isbn = parts[0].substring(6); // Remove "ISBN: "
                const location = parts[1].substring(10); // Remove "Location: "

                // Fill both the ISBN and location input fields
                $("#isbnInput").val(isbn);
                $("#locationInput").val(location);

                // Optionally, you can focus on the name input field or perform any other action here
                // $("#name").focus();

            } else {
                // Alert the user if the QR code format is invalid
                alert('Invalid QR code format.');
            }
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
