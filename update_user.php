<?php
session_start();

@include 'config/config.php';
$user_id = $_GET['updateid'];

if (isset($_POST['saveBook'])) {

    $sql = "select * from `book` where book_id='$book_id'";
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


    $sql = "UPDATE `book` SET `isbn`='$isbn',`title`='$title',`author`='$author',`publication_date`='$publication_date',`status`='[value-6]' WHERE book_id='$book_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        $_SESSION['statusupdate'];
        header('location: admin_page.php');
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

<?php @include 'includes/header.php' ?>



    <div class="form-container">
        <!-- <div class="col-md-12"> -->
            <div class="card">
                <div class="card-header">
                    <h4>
                        Update book
                        <a href="admin_page.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php

                    
                    $sql = "SELECT * FROM `book` WHERE book_id = '$book_id' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>


                    <form method="POST">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>ISBN</label>
                                <input type="text" name="isbn" class="form-control" autocomplete="off" value="<?php echo $row['isbn'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" autocomplete="off" value="<?php echo $row['title'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Author</label>
                                <input type="text" name="author" class="form-control" autocomplete="off" value="<?php echo $row['author'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Publication date</label>
                                <input type="date" name="publication_date" class="form-control" autocomplete="off" value="<?php echo $row['publication_date'] ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3 text-end">
                                <button type="submit" name="saveBook" class="btn btn-danger">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
