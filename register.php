
<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    header('location: account.php');
    exit; // Ensure script stops executing after redirection
}


include('server/connection.php');



if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($password !== $confirmPassword){
        header('location: register.php?error=Passwords do not match');
    } elseif(strlen($password) < 6){
        header('location: register.php?error=Password must be at least 6 characters');
    } else {
        $stmt1 = $conn->prepare("SELECT * FROM users WHERE user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->store_result();
        $num_rows = $stmt1->num_rows;

        if ($num_rows != 0){
            header('location: register.php?error=User with this email already exists');
        } else {
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $name, $email, md5($password));

            if($stmt->execute()){
                #user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=You registered successfully!'); // Redirect to login page
            } else {
                header('location: register.php?error=Could not create account');
            }
        }
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
        <h2 class="script-font">Register</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">

            <p style="color: red;"><?php  if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="Password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="ConfirmPassword" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name ="register" value="register">
            </div>
            <div class="form-group">
                <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
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