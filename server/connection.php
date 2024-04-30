<?php
// Database connection parameters
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "event";

// Create a connection to the database
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Prepare SQL statement
$sql = "SELECT * FROM featured_products LIMIT 5";

// Execute SQL statement
$result = $conn->query($sql);

// Initialize an empty array to store the fetched data
$featured_products = [];

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

