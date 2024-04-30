<?php   
  session_start();

  if(isset($_POST['order_pay_btn'])){
    
    $order_total_price =$_POST['order_total_price'];

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
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weigth-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
            <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>
                <p>Total payment: $ <?php echo $_SESSION['total']; ?></p>
                <form action="paynow.html" method="get">
                    <input type="submit" class="btn btn-primary" value="Pay Now">
                </form>
            <?php } else if(isset($_POST['order_status']) && $_POST['order_status'] == "unpaid"){?>
                <p>Total payment: $ <?php echo $_SESSION['order_total_price']; ?></p>
                <form action="paynow.html" method="get">
                    <input type="submit" class="btn btn-primary" value="Pay Now">
                </form>
            <?php } else { ?>
                <p>Your cart is empty</p>
            <?php } ?>
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