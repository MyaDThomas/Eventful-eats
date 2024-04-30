<?php
include('server/connection.php');

// Check if the order ID is provided in the URL
if(isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    // Sanitize and validate the order_id
    $order_id = intval($_GET['order_id']);
    echo "Order ID provided: $order_id"; // Debugging output
    // Check if $order_id is a valid integer
    if($order_id > 0) {
        // Proceed with fetching order details for the provided order ID
        $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $order_details = $stmt->get_result();
        $order_total_price = caltotalorderprice($order_details);

        // Check if any order details found
        if ($order_details->num_rows > 0) {
            // Order details found, proceed to display
            // Your code to display order details goes here
        } else {
            // No order details found for the provided order ID
            echo "No order details found!";
        }
    } else {
        // Invalid order ID provided
        echo "Invalid order ID!";
    }
} else {
    // No order ID provided in the URL parameters
    echo "No order ID provided in the URL";
}

// Function to calculate total order price
function caltotalorderprice($order_details) {
    $total = 0;
    foreach($order_details as $row) { 
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += ($product_price * $product_quantity);
    }
    return $total;
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
                <li><a class="active" href="login.php">Login</a></li>
                <li> <a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
</section>

    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
            <h2 class="script-font">Order Details</h2>
            <hr class="mt-5 pt-5">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>product</th>
                <th>price</th>
                <th>Quantity</th>
            </tr>

            <?php foreach ($order_details as $row) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>">
                            <div>
                                <p class="mt-3"><?php echo $row['product_name']; ?></p>
                                <p class="mt-3"><?php echo $row['product_flavor']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span><?php echo $row['product_price']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['product_quantity']; ?></span>
                    </td>
                    <td>

                    </td>

                </tr>

            <?php } ?>
        </table>
        <form style="float: right;" method="POST" action="payment.php">
            <input type="hidden" value="<?php echo $order_total_price; ?>" name="order_total_price">
        </form>
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
</body>

</html>

