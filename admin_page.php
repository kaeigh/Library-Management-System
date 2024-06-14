<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['admin_name'])) {
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

    <?php @include 'includes/header.php' ?>

    <!-- Add Book Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="addbook.php">
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control" name="author">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Publication Date</label>
                            <input type="date" class="form-control" name="publication_date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="quantity">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <select name="location">
                                <option value="Shelf 1">Shelf 1</option>
                                <option value="Shelf 2">Shelf 2</option>
                                <option value="Shelf 3">Shelf 3</option>
                                <option value="Shelf 4">Shelf 4</option>
                                <option value="Shelf 5">Shelf 5</option>
                                <option value="Shelf 6">Shelf 6</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="saveBook">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-end my-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
            ADD BOOK
        </button>
    </div>

    <?php
   if (isset($_GET['msg'])) {
      $msg = $_GET['msg'];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
               ' . $msg . '
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
   }
   ?>

    <div class="col-sm-12 p-3">
        <table id="example" class="table table-sm table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>TITLE</th>
                    <th>AUTHOR</th>
                    <th>DATE OF PUBLICATION</th>
                    <th>QUANTITY</th>
                    <th>LOCATION</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // Include the database configuration file
            @include 'config/connect.php';

            // Fetch data from the database
            $stmt = $conn->prepare("SELECT * FROM book");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                  // Output data for each row
                  echo '<tr>
                           <td>' . $row['isbn'] . '</td>
                           <td>' . $row['title'] . '</td>
                           <td>' . $row['author'] . '</td>
                           <td>' . $row['publication_date'] . '</td>
                           <td>' . $row['quantity'] . '</td>
                           <td>' . $row['location'] . '</td>
                           <td>
                              <button class="btn btn-primary btn-sm" onclick="generateQrCode(\'' . $row['isbn'] . '\', \'' . $row['location'] . '\')">QRcode</button>
                              <button class="btn btn-success btn-sm"><a href="update.php?updateid=' . $row['id'] . '" class="text-light">Edit</a></button>
                           </td>
                        </tr>';
               }
            } else {
               echo '<tr><td colspan="5">No records found</td></tr>';
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
                <div class="modal-body text-center" id="qrModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Function to generate QR code and show modal
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
    </script>

</body>

</html>

<?php @include 'includes/footer.php' ?>
