<?php
session_start();
@include 'config/config.php';

$id = $_GET['returnid'];

if (isset($_POST['return'])) {
    // Fetch the book details from the database
    $sql = "SELECT * FROM `borrow` WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Get the ISBN and name of the book from the form
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = $_POST['location'];

    // Insert the returned book into the 'returning' table
    $insert = "INSERT INTO `returns` (isbn, name,location) VALUES ('$isbn','$name','$location')";
    mysqli_query($conn, $insert);

    // Delete the book from the 'borrow' table
    $delete = "DELETE FROM `borrow` WHERE id='$id'";
    mysqli_query($conn, $delete);

    // Check if the return process was successful
    if ($delete) {
        header("location: qr_code_return.php?msg=Book returned successfully!");
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
    <title>QR Code Return</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
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
                <?php
                // Fetch the book details for the return form
                $sql = "SELECT * FROM `borrow` WHERE id = '$id' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <form method="post">
                    <div class="header-text">
                        <h4>Book info</h4>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label mb-0">International Standard Book Address</label>
                        <input type="text" class="form-control form-control-sm" name="isbn" id="isbn" required
                            autocomplete="off" value="<?php echo $row['isbn'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label mb-0">Location</label>
                        <input type="text" class="form-control form-control-sm" name="location" id="location" required
                            autocomplete="off" value="<?php echo $row['location'] ?>" readonly>
                    </div>
                    <hr>
                    <div class="header-text">
                        <h4>Borrower info</h4>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label mb-0">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" required
                            autocomplete="off" value="<?php echo $row['name'] ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary" name="return">Return</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>
    <div class="row header-text container">
        <h4>Returned books</h4>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
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
                            // Fetch the list of borrowed books for display
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
                                        <td>' . $status . '</td>
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