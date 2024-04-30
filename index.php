<?php
// Include the file with the database connection details
include('server/connection.php');

// Initialize an empty array to store the fetched data
$featured_products = [];

// Attempt to establish a connection to the database
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "SELECT * FROM featured_products LIMIT 10";

// Execute SQL statement
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Loop through each row and fetch the data
    while ($row = $result->fetch_assoc()) {
        // Add the fetched data to the array
        $featured_products[] = $row;
    }
} else {
    echo "No featured products found";
}

// Close the database connection

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventful Eats - Catering Services</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
<style>
    #Treat1 {
    text-align: center;
    }

    #Treat1 .pro-container {
    display: flex;
    justify-content: space-between;
    padding-top: 20px;
    flex-wrap: wrap;
    }

    #Treat1 .pro {
    width: 25%;
    min-width: 250px;
    padding: 10px 12px;
    border: 1px solid #cce7d0;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.2);
    margin: 15px;
    transition: 0.2s ease;
    position: relative;
    }

    #Treat1 .pro:hover {
    box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.6);
    }

    #Treat1 .pro img {
    width: 100%;
    border-radius: 20px;
    }

    #Treat1 .pro .des {
    text-align: start;
    padding: 10px 0;
    }

    #Treat1 .pro .des span {
    color: #606063; /* changed from 'columns' */
    font-size: 12px;
    }

    #Treat1 .pro .des h5 {
    padding-top: 7px;
    color: #1a1a1a;
    font-size: 14px;
    }

    #Treat1 .pro .des i {
    font-size: 12px;
    color: rgb(243, 181, 25);
    }

    #Treat1 .pro .des h4 {
    padding-top: 7px;
    font-size: 15px;
    font-weight: 700;
    color: #088178;
    }

    #Treat1 .pro .bag {
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 50px;
    background-color: #e8f6ea;
    font-weight: 500;
    color: #888178;
    border: 1px solid #cce7da;
    position: absolute;
    bottom: 20px;
    right: 10px;
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

    <section id="hero">
        <img src="assets/imgs/Kitchen.jpg" alt="Sweets" class="background-image1">
        <div class="content">
            <h4 class="script-font">Welcome to Eventful Eats</h4>
        </div>
    </section>

    <section id="feature" class="section-p1">
        <a href="forms.php" class="fe-box">
            <h6>Catering Service</h6>
        </a>
        <a href="shop.html" class="fe-box">
            <h6>View Menu</h6>
        </a>
        <a href="admin/alogin.php" class="fe-box">
            <h6>Admin Login</h6>
        </a>
    </section>

    <section id="Treat1" class="section-p1">
    <h2>Featured Treats</h2>
    <div class="pro-container">
        <?php foreach ($featured_products as $row) { ?>
            <div class="pro">
                <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                <div class="des">
                    <span>Sweet Treats</span>
                    <h5><?php echo $row['product_name']; ?></h5>
                    <!-- Add other product details here -->
                    <h4>$<?php echo $row['product_price']; ?></h4>
                </div>
                <a class="normal" href="single_product.php?id=<?php echo $row['id']; ?>"><i>add to cart</i></a>
            </div>
        <?php } ?>
    </div>
</section>


    <section id="banner" class="section-m1">
        <img src="assets/imgs/black_banner.jpg" alt="banner" class="background-image2">
        <div class="c">
            <h4 class="script-font">Catering Services</h4>
            <a href="forms.php" class="normal">Learn More</a>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <h4>Contact</h4>
            <p>Address: University, MS 38677 </p>
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
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
