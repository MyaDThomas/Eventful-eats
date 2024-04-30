<?php 
session_start();

// Check if the cart is not empty
if(empty($_SESSION['cart'])){
    // Redirect to the shop page or display a message
    header('location: shop.html');
    exit;
}

// Check if the user is not logged in
if(!isset($_SESSION['logged_in'])){
    // Set a message to be displayed
    $message = "Please login/register to place an order";
}

// Function to clear the cart
function clearCart() {
    // Unset or remove the cart session variable
    unset($_SESSION['cart']);
}

// Example of placing an order
function placeOrder() {
    // Your code to process the order and store it in the database
    
    // Clear the cart after the order is successfully placed
    clearCart();
}

// Example usage
// Check if the place order button is clicked
if(isset($_POST['place_order'])) {
    // Call the placeOrder function
    placeOrder();
    // Redirect to a confirmation page or any other page after placing the order
    header('Location: payment.php');
    exit;
}


?>

<!DOCTYPE html>
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
                <li><a  href="index.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li> <a class="active" href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <section class="my-5 py-5">
        <div class="container text-center mt-2 pt-5">
            <h2 class="script-font">Check Out</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <p class="text-center" style="color: red;"><?php if(isset($message)) { echo $message; } ?></p>
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Total amount: $<?php echo $_SESSION['total']; ?><p>
                    <?php if(isset($message)) { ?>
                        <a href="login.php" class="btn btn-primary">LOGIN</a>
                    <?php } else { ?>
                        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
                    <?php } ?>
                </div>
            </form>
        </div>
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
            <a href="contact.html">Contact Us</a>
            <a href="Admin/alogin.php">Admin Login</a>
        </div>
        <div class="copyright"> 
            <p>© 2024 Eventful Eats. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
