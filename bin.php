<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script defer src="js/script.js"></script>
    <title>Bin</title>
</head>

<body>

    <?php @include 'includes/header.php' ?>

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
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // Include the database configuration file
            @include 'config/config.php';

            // Fetch data from the database
            $stmt = $conn->prepare("SELECT * FROM bin");
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
                           <td>
                              <button class="btn btn-success btn-sm"><a href="binedit.php?binedit=' . $row['id'] . '" class="text-light">Retrieve</a></button>
                              <button class="btn btn-danger btn-sm"><a href="bindel.php?bindel=' . $row['id'] . '" class="text-light">Delete</a></button>
                           </td>
                        </tr>';
               }
            } else {
               echo '<tr><td colspan="5">No records found</td></tr>';
            }
            ?>




</body>

</html>

