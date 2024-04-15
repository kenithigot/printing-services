<!-- Db_con connection -->
<?php include('db_connections/db_signin.php'); ?>

<!-- Loading bar -->
<?php include('spinner.php');?>

<!DOCTYPE html>

<html>
<head>

    <!-- Header -->
    <?php include('includes/header.php');?>

    <!-- Libraries -->
    <?php include('resources/libraries.php');?>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>

<script>
    function preventBack(){
        window.history.forward()
    };
        setTimeout("preventBack()", 0);
            window.onunload = function(){
            null;
        } 
</script>

<style>

body {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    position: relative;
    overflow: hidden; /* Prevent scrollbars caused by the video */
    background-color:#15d17a;
}

.background-video {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* Place the video behind other content */
    overflow: hidden; /* Hide any overflowing video */
    opacity:0.5;
   
}

#myVideo {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

#login-button {
    background-color: #50C878; 
    color: white; 
}
.password-icon {
    position: absolute;
    top: 50%;
    right: 10px;    
    transform: translateY(-50%);
    cursor: pointer;    
}
.container-login {
    background-color: rgba(255, 255, 255, 0.8); /* Adjust opacity if needed */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 5px 20px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

.container-font {
    text-align: center;
    margin-bottom: 20px;

}

.play-button-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-20%, -20%);
    z-index: 2;
    cursor: pointer;
    font-size: 50px;
    color: white;
}
</style>

</head>

<body>
    <div class="background-video">
        <video playsinline autoplay muted loop id="myVideo">
            <source src="video/video.mp4" type="video/mp4">
        </video>
    </div>
    <div class="container-login">
        <div class="container-font">
            <h3>LOGIN - ADMIN</h3>
        </div>
        <form action="" method="POST" style="margin-bottom:5px;">  
            <div class="form-floating mb-3">
                <div class="input-group">
                    <span class="input-group-text" style="font-size:20px;">
                        <i class="fas fa-user-alt"></i>
                    </span>
                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" style="padding: 15px;border-radius: 0 .5rem .5rem 0;color:black;"required>
                </div>
            </div>
            <div class="form-floating mb-3">
                <div class="input-group">
                    <span class="input-group-text" style="font-size:20px;">
                        <i class="fas fa-key"></i>
                    </span>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" style="padding: 15px;border-radius: 0 .5rem .5rem 0;color:black;"required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" id="login-button" style="margin-top:30px;">Sign In</button>
        </form>
        <br>
        <div class="container-font" >
            <h6>
                Want to view the data?
                <a href="qrlogin.php" style="color:black;border-bottom:1px solid black;">Click Here!</a>
            </h6>
        </div>
    </div>
        
    <script>
        <?php
            if ($loginStatus === false) {
                echo 'Swal.fire({
                    icon: "error",
                    title: "Invalid Credentials",
                    text: "Incorrect email or password",
                });';
            }
            else if ($loginStatus === true) {
                echo 'Swal.fire({
                    icon: "error",
                    title: "Good",
                    text: "Incorrect email or password",
                });';
            }
        ?>
        document.getElementById("login-button").addEventListener("click", function(event) {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if (!email || !password) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Can\'t Login',
                    text: 'Please fill in both email and password!',
                });
            }
        });
    </script>

</body>
</html>