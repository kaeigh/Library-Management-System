<?php
session_start();

@include 'config/config.php';
$id = $_GET['binedit'];


if (isset($_POST['retrieve'])) {

    $sql = "select * from `bin` where id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $isbn = $row['isbn'];
    $title = $row['title'];
    $author = $row['author'];
    $publication_date = $row['publication_date'];



    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication_date = $_POST['publication_date'];
    $quantity = $_POST['quantity'];
    $location= $_POST['location'];


    $sql = "INSERT INTO book(isbn,title,author,publication_date,quantity,location) VALUES('$isbn','$title','$author','$publication_date','$quantity','$location')";


    $result = mysqli_query($conn, $sql);
if (!$result) {
    die(mysqli_error($conn));
}


    $delete = "DELETE FROM `bin` WHERE id='$id'";
    mysqli_query($conn, $delete);

    // Check if the return process was successful
    if ($delete) {
        header("location: admin_page.php?msg=Book retrieve successfully!");
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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script defer src="js/script.js"></script>
    <link rel="stylesheet" href="css/styling.css">


    <title>admin db</title>
</head>

<body>

    <div class="form-container">
        <!-- <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <h4>
                    Retrieve book
                    <a href="bin.php" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?php

                    
                    $sql = "SELECT * FROM `bin` WHERE id = '$id' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>


                <form method="POST">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" autocomplete="off"
                                value="<?php echo $row['isbn'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" autocomplete="off"
                                value="<?php echo $row['title'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Author</label>
                            <input type="text" name="author" class="form-control" autocomplete="off"
                                value="<?php echo $row['author'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Publication date</label>
                            <input type="date" name="publication_date" class="form-control" autocomplete="off"
                                value="<?php echo $row['publication_date'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Quantity</label>
                            <input type="text" name="quantity" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Location</label>
                            <select name="location" type="text" class="form-control" autocomplete="off">
                                <option value="Shelf 1">Shelf 1</option>
                                <option value="Shelf 2">Shelf 2</option>
                                <option value="Shelf 3">Shelf 3</option>
                                <option value="Shelf 4">Shelf 4</option>
                                <option value="Shelf 5">Shelf 5</option>
                                <option value="Shelf 6">Shelf 6</option>

                            </select>

                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="mb-3 text-end">
                            <button type="submit" name="retrieve" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
    </div>

</body>

</html>

<?php @include 'includes/footer.php' ?>