<?php

// Include the file with the database connection details
include('connection.php');

// Establish connection to the database
$stmt = $conn->prepare("SELECT * FROM featured_products LIMIT 5");

$stmt->execute();

$featured_products = $stmt->get_result();




?>

