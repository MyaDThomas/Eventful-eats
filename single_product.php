
<?php
include('server/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM featured_products WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();
    $product = $stmt->get_result();
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
                <li><a  href="index.php">Home</a></li>
                <li><a class="active" href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li> <a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

<section id="prodetails" class="section-p1">
    <div class="singleproimage">
        <?php while($row = $product->fetch_assoc()){?>
    
    <img src="assets/imgs/<?php echo $row['product_image'];?>" width="100%" id="mainimage" alt="">
    <div class="smallimagegroup">
        <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image1'];?>" width="100%" class="small-img">
        </div>
        <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image2'];?>" width="100%" class="small-img">
        </div>
        <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image3'];?>" width="100%" class="small-img">
        </div>
        <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image4'];?>" width="100%" class="small-img">
        </div>
    </div>
</div>



<div class="single-pro-details">
    <h6>Home/Cakes</h6>
    <h4><?php echo $row['product_name']; ?></h4>
    <h2><?php echo $row['product_price'];?></h2>
<form method="POST" action="cart.php">

        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="hidden" name="product_image" value="<?php echo $row['product_image'];?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>">
<select name="product_flavor">
            <option value="">Select Flavor</option>
            <option value="Chocolate">Chocolate</option>
            <option value="Strawberry">Strawberry</option>
            <option value="Red Velvet">Red Velvet</option>
            <option value="Funfetti">Funfetti</option>
        </select>
    <input type="number" name="product_quantity" value="1">
    <button class="normal" type="submit" name="add_to_cart">Add to cart</button>
</form>

<h4>Product Details</h4>
<span><?php echo $row['product_description'];?></span>

<?php }?>

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
    <script>
        var mimage = document.getElementById("mainimage");
        var smallImages = document.getElementsByClassName("small-img");

        for (var i = 0; i < smallImages.length; i++) {
            smallImages[i].onclick = function(){
                mimage.src = this.src; // 'this' refers to the clicked small image
            };
        }
    </script>
</body>
</html>
