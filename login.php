<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    header('location: account.php');
    exit; // Ensure script stops executing after redirection
}

include('server/connection.php');


if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? AND user_password=? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows() == 1){
        $stmt->bind_result($user_id, $username, $user_email, $user_password);
        $stmt->fetch();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $username;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['logged_in'] = true;

        header('location: account.php?login_success=logged in successfully'); // Redirect to account page
    } else {
        header('location: login.php?error=Could not verify your account');
    }
}
?>






<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventful Eats - Catering Services</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Include your custom font here if needed -->
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
	<section id="header">
        <h1 class="script-font">Eventful Eats</h1>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a class="active" href="login.php">Login</a></li>
                <li> <a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
</section>

<section class="my-5 py-5">
    <div class="container text-center mt-2 pt-5">
        <h2 class="script-font">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="login-form" action="login.php" method="POST">

        <p style="color: red"  class="text-center"><?php  if(isset($_GET['error'])) { echo $_GET['error']; }?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login_btn" name="login_btn" value="Login">
            </div>
             <div class="form-group">
                <a id="register-url" href="register.php" class="btn">Dont have an Account? Register</a>
            </div>
        </form>
    </div>
    
</section>






<footer class"section-p1">
   <div class="col">
        <h4>Contact</h4>
        <p>Address: University,Ms 38677 </p>
        <p>Phone: (662) 915-7211</p>
        <p>Hours: 9am - 9pm, Mon - Sun</p>
    </div> 
    <div class="col">
        <h4>About</h4>
        <a href="about.html">About Us</a>
        <a href="forms.php">Catering Services</a>
        <a href="account.php">Contact Us</a>
        <a href="admin/alogin.php">Admin Login</a>

    </div>
    <div class="copyright"> 
        <p>© 2024 Eventful Eats. All rights reserved.</p>
    </div>
</footer>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>