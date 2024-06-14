<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
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

    <title>admin db</title>
</head>

<body>

    <?php @include 'includes/userheader.php' ?>

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

    @include 'config/connect.php';

    $stmt = $conn->prepare("SELECT * FROM book");
    $stmt->execute();

    $result = $stmt->get_result();

    ?>

    <div class="col-sm-12 p-3">
        <table id="example" class="table table-sm table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">AUTHOR</th>
                    <th scope="col">DATE OF PUBLICATION</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">LOCATION</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>

                    <tr>
                        <th scope="row"><?= $row['isbn'] ?></th>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['author'] ?></td>
                        <td><?= $row['publication_date'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['location'] ?></td>
                        <td>
                        <button class="btn btn-primary btn-sm" onclick="deployQrCode('<?= $row['isbn'] ?>', '<?= $row['location'] ?>')">QR code</button>

                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- QR Modal -->
    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalTitle">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="qrModalBody">

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function generateQrCode(isbn, location) {
        // Concatenate ISBN and location
        var dataString = "ISBN: " + isbn + ", Location: " + location;

        // Generate the QR code URL using the combined string
        var qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + encodeURIComponent(dataString);
        
        // Set the QR code image in the modal body
        $("#qrModalBody").html('<img src="' + qrCodeUrl + '" alt="QR Code">');

        // Show the modal
        $("#qrCodeModal").modal("show");
    }

    // Function to deploy the QR code with both ISBN and location
    function deployQrCode(isbn, location) {
        // Call the generateQrCode function with both ISBN and location
        generateQrCode(isbn, location);
    }
</script>

<br>
<br>
<br>


</body>

</html>

<?php @include 'includes/footer.php' ?>

