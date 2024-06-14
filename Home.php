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
    <link rel="stylesheet" href="css/styling.css">

    <title>Document</title>
</head>

<body>

    <?php @include 'includes/header.php' ?>

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/book-img 1.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>There is no problem that a library card can’t solve.</p>
                        <p> Eleanor Brown </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/book-img 4.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>Books and doors are the same thing. You open them, and you go through into another world.</p>
                        <p> – Jeanette Winterson </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/book-img 3.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>I don’t have to look far to find treasures. I discover them every time I visit the library.</p>
                        <p> – Michael Embry </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    <br>
    <br>
    <br>
    <br>
    <div class="header text-center">
        <h4>How to use QRcode?</h4>
    </div>
    <div class="container-fluid">
        <div class="card-group">

            <div class="card">
                <img src="images/qr.png" class="card-img-top" alt="..." style="width: 50%; display: block;
margin-left: auto;
margin-right: auto; margin-top: 35px;">
                <div class="card-body">
                    <h3 class="card-title">Step 1:</h3>
                    <h5 class="card-text">Open and take a photo of book QRcode you want to borrow</h5>
                </div>
            </div>
            <div class="card">
                <img src="images/scan.jpg" class="card-img-top" alt="..." style="width: 50%; display: block;
margin-left: auto;
margin-right: auto; margin-top: 35px;">
                <div class="card-body">
                    <h3 class="card-title">Step 2:</h3>
                    <h5 class="card-text">Go to the transaction section to scan the QRcode</h5>
                </div>
            </div>
            <div class="card">
                <img src="images/attractive.jpg" class="card-img-top" alt="..." style="width: 50%; display: block;
margin-left: auto;
margin-right: auto; margin-top: 35px;">
                <div class="card-body">
                    <h3 class="card-title">Step 3:</h3>
                    <h5 class="card-text">Then, claim your borrowed book to the Librarian</h5>
                </div>
            </div>
        </div>
    </div>


</body>

</html>