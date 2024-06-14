<?php
session_start();

@include 'config/config.php';

if (isset($_POST['saveBook'])) {

   $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
   $title = mysqli_real_escape_string($conn, $_POST['title']);
   $author = mysqli_real_escape_string($conn, $_POST['author']);
   $publication_date = mysqli_real_escape_string($conn, $_POST['publication_date']);
   $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
   $location = $_POST['location'];


   $select = " SELECT * FROM book WHERE isbn = '$isbn' && title = '$title' && author = '$author'";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      header("location:addbook.php?msg=Data already exist!");
   } else {


      $insert = "INSERT INTO book(isbn,title,author,publication_date,quantity,location) VALUES('$isbn','$title','$author','$publication_date','$quantity','$location')";
      mysqli_query($conn, $insert);
      header("location:admin_page.php?msg=Data inserted successfully!");
   }
};


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



   <div class="form-container ">
      <!-- <div class="col-md-12"> -->
         <div class="card">
            <div class="card-header">
               <h4>
                  Add book
                  <a href="admin_page.php" class="btn btn-primary float-end">Back</a>
               </h4>
            </div>
            <div class="card-body">

            <?php
   if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="alert alert-warning alert-dismissible fade show"
    role="alert">
    '.$msg.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
   ?>
               <form method="POST">
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>ISBN</label>
                        <input type="text" name="isbn" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label>Publication date</label>
                        <input type="date" name="publication_date" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <hr>
                  <div class="col-md-12">
                     <div class="mb-3 text-end">
                        <button type="submit" name="saveBook" class="btn btn-primary">Save</button>
                     </div>
                  </div>


               </form>
            </div>
         <!-- </div>
      </div> -->
   </div>

</body>

</html>

<?php @include 'includes/footer.php' ?>