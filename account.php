<?php 
session_start();
include('server/connection.php');

// Set the timezone to Central Time
date_default_timezone_set('America/Chicago');

if(isset($_SESSION['logged_out'])){
    header('location: index.php');
    exit;
}

if(isset($_GET['logout']) && $_GET['logout'] == 1){
    // If the logout parameter is set and equals 1, perform logout
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    header('location: login.php');
    exit;
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirmPassword){
        header('location: account.php?error=Passwords do not match');
        exit;
    } elseif(strlen($password) < 6){
        header('location: account.php?error=Password must be at least 6 characters');
        exit;
    } else {
        // Prepare the SQL statement to update the password
        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param('ss', md5($password), $user_email);
            if($stmt->execute()){
                header('location: account.php?message=Password has been updated successfully.');
                exit;
            } else {
                header('location: account.php?error=Could not update password.');
                exit;
            }
        } else {
            header('location: account.php?error=Database error.');
            exit;
        }
    }
}

 
if(isset($_SESSION['logged_in'])){

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventful Eats - Catering Services</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        .orders .product-info{
            display: flex;
            flex-wrap: wrap;
        }
        .orders table {
            width: 100%;
            border-collapse: collapse;
        }
        .orders th{
            padding: 5px 20px;
            color: white;
            background-color: #088178;
        }
        .orders td{
            padding: 10px 20px;
        }
        .orders .order-details-btn{
            color: white;
            background-color: #088178;
        }
    </style>
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
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-2 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; }?></p>
                <p class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; }?></p>
                <h3 class="script-font">Account Info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name: <span><?php if(isset($_SESSION['user_name'])){  echo $_SESSION['user_name'];} ?></span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];} ?></span></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                    <p class="text-center" style="color: green;"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?></p>
                    <h3>Change password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password"  name="password" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm"  name="confirmPassword" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weigth-bold text-center">Your Orders</h2>
            <hr class="mt-5  pt-5">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Order id</th>
                <th>Order cost</th>
                <th>Order status</th>
                <th>Order date (Central Time)</th>
                <th>Order details</th>
            </tr>
            <?php   while($row = $orders->fetch_assoc() ){ ?>
                <tr>
                    <td>
                        <span><?php  echo $row['order_id']; ?></span>
                    </td>
                    <td>
                        <span><?php  echo $row['order_cost']; ?></span>
                    </td>
                    <td>
                        <span><?php  echo $row['order_status']; ?></span>
                    </td>
                    <td>
                        <span><?php  echo date("n/j/Y ", strtotime($row['order_date'])); ?></span>
                    </td>
                    <td>
                        <form method="GET" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                            <input class="btn order-details-btn"  name="order_details_btn" type="submit" value="details">
                        </form>
                    </td>

                </tr>

            <?php }?>
        </table>

    </section>

    <footer class="section-p1">
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
            <a href=ccontact.html#">Contact Us</a>
            <a href="Admin/alogin.php">Admin Login</a>
        </div>
        <div class="copyright"> 
            <p>© 2024 Eventful Eats. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
