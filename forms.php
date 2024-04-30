<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventful Eats - Catering Services</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Include your custom font here if needed -->
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<section id="form">
    <form action="process.php" method="post">
        <span>Please fill out catering event form</span>
        <input type="text" placeholder="Enter name" name="name">
        <input type="email" placeholder="E-mail" name="email">
        <input type="datetime-local" placeholder="Date and Time of Event" name="event_date">
        <input type="text" placeholder="Location of event" name="location">
        <input type="number" placeholder="How many guests will be at the event?" name="guests">
        <input type="text" placeholder="Special Occasion" name="special_occasion">
        <input type="text" placeholder="Enter dessert" name="dessert1">
        <input type="number" placeholder="Quantity" name="dessert1_quantity">
        <input type="text" placeholder="Enter dessert" name="dessert2">
        <input type="number" placeholder="Quantity" name="dessert2_quantity">
        <input type="text" placeholder="Enter dessert" name="dessert3">
        <input type="number" placeholder="Quantity" name="dessert3_quantity">
        <input type="text" placeholder="Enter dessert" name="dessert4">
        <input type="number" placeholder="Quantity" name="dessert4_quantity">
        <textarea name="description" id="" cols="40" rows="20" placeholder="Event Description"></textarea>
        <button class="normal" type="submit">Submit</button>
    </form>
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
<script src="javascript/homepage_script.js"></script>
</body>
</html>
