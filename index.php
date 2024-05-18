<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $_SESSION['loggedin'] = true;
    header('Location: dashboard/');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Printing Services</title>
    <!-- Loading bar -->
    <?php include('spinner.php'); ?>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
    .image-style {
        margin: 20px 280px;
        padding-top: 20px;
        border-radius: 50px;
        background: linear-gradient(145deg, #caeae0, #aac5bc);
        box-shadow: 7px 7px 14px #4d9880, -7px -7px 14px #69cead;
    }
    .img-front {
        mix-blend-mode: multiply;
    }
</style>
<body>
    <div class="container">
        <div class="p-5 text-center bg-body-tertiary">
            <div class="image-style">
                <img class="img-front" src="resources/imgs/printing-services.jpeg" alt="Printing Services" height="150">
            </div><br>
            <h1 class="text-body-emphasis">Welcome Back User</h1><br>
            <p class="col-lg-8 mx-auto fs-5">
                <strong>LOCATED AT:</strong> National Highway, Brgy. Digson, Bonifacio, Misamis Occidental
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                <form method="post" action="">
                    <button class="btn btn-outline-primary btn-lg px-4 rounded-pill" type="submit" name="login">
                        LOGIN HERE
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
