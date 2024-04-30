<?php 
session_start();
include('connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php?message=please login/register to place a order');
    exit;
}

if(isset($_POST['place_order'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = 'unpaid';
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Prepare the SQL statement for orders table
    $stmt_orders = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_number, user_city, user_address, order_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters and execute the statement for orders table
    $stmt_orders->bind_param('dsiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
    $stmt = $stmt_orders->execute();

    if(!$stmt){
       // header('location: index.php');
        exit;
    }



    // Get the ID of the inserted order
    $order_id = $stmt_orders->insert_id;

    // Prepare the SQL statement for order_items table
    $stmt_items = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_flavor, product_image, product_price, product_quantity, user_id, order_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Loop through cart items and insert into order_items table
    foreach($_SESSION['cart'] as $key => $value){
        $id = $value['id'];
        $product_name = $value['product_name'];
        $product_flavor = $value['product_flavor']; // Added product flavor
        $product_image = $value['product_image'];
        $product_price = $value['product_price'];
        $product_quantity = $value['product_quantity'];

        // Bind parameters and execute the statement for order_items table
        $stmt_items->bind_param('iisssisis', $order_id, $id, $product_name, $product_flavor, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt_items->execute();
    }

    

    header('location: ../payment.php?order_status="order placed successfully!"');
}


?>


