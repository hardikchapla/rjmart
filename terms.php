<?php
  include('connection/connection.php');
  $terms = $db->query("SELECT * FROM terms_and_conditions");
  $data = array();
  while($feterms = $terms->fetch()){
    $data[$feterms['slug']] = $feterms['description'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Terms & Condition</title>
    <link rel="icon" type="image/x-icon" href="admin/assets/img/favicon.png" />
    <!-- Bootstrap core CSS -->
    <link href="web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="web/css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="admin/assets/img/Logo_jpg.png" class="navbar-logo" alt="logo" width="130px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="privacy.php">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="terms.php">Terms & Condition</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 order-lg-1 mt-5">
                    <div class="p-5 mt-5">
                        <h2 class="display-4"><?= $data['terms_and_condition_header'] ?></h2>
                        <?= $data['terms_and_condition_description'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; RJ Mart</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="web/vendor/jquery/jquery.min.js"></script>
    <script src="web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>