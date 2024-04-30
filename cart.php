<?php
session_start();

// Function to calculate total cart value
function caltotal(){
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total += $price * $quantity; // Calculate total
    }
    $_SESSION['total'] = $total;
}

// Check if session variables are set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
}

// Check if product is being added to cart
if (isset($_POST['add_to_cart'])) {
    // Initialize flag to track if product is already in the cart
    $product_already_added = false;

    // Check if the current product is already in the cart
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_name'] == $_POST['product_name'] && $product['product_flavor'] == $_POST['product_flavor']) {
            // Increment quantity if name and flavor match
            $_SESSION['cart'][$key]['product_quantity'] += $_POST['product_quantity'];
            $product_already_added = true;
            break;
        }
    }

    // If product is not already in the cart, add it
    if (!$product_already_added) {
        // Add the product to the cart
        $id = $_POST['id'];
        $product = array(
            'id' => $_POST['id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'],
            'product_flavor' => $_POST['product_flavor']
        );
        $_SESSION['cart'][$id] = $product;
    }

    // Update total after adding item to cart
    caltotal();
}

// Check if the order is successfully placed
if (isset($_POST['checkout'])) {
    // Your order processing logic here

    // Assuming the order is successfully placed
    $order_placed_successfully = true;

    // If order is successfully placed, clear the cart
    if ($order_placed_successfully) {
        // Clear the cart session variables
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
    }
}

// Check if remove button is clicked
if (isset($_POST['remove_product'])) {
    $remove_id = $_POST['id'];
    // Check if the product with the given ID exists in the cart
    if (isset($_SESSION['cart'][$remove_id])) {
        // Remove the product from the cart
        unset($_SESSION['cart'][$remove_id]);
        // Recalculate total
        caltotal();
    }
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
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li> <a class="active" href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="script-font">Your Cart</h2>
        <hr>
    </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <p><?php echo $value['product_flavor']; ?></p>

                                <small>$<?php echo $value['product_price']; ?></small>
                                <br>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="remove">
                                </form>
                                
                            </div>
                        </div>
                    </td>
                    <td>
                            
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                            
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                            
                        </form>
                        
                    </td>
                    <td>
                        <span>$</span>
                        <span class="product-price">$<?php echo intval($value['product_quantity']) * floatval($value['product_price']); ?></span>


                    </td>
                </tr>
            <?php } ?>
        </table>
    <div class="cart-total">
        <table>
                <td>Total</td>
                <td>$<?php echo $_SESSION['total'];?></td>
            </tr>
        </table>
    </div>
    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <input type="submit" name="checkout" class="checkout-btn" value="Checkout">
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
