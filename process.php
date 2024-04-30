
<?php
// Include your server connection file
include('server/connection.php');

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$event_date = filter_input(INPUT_POST, "event_date", FILTER_SANITIZE_STRING); // Sanitize string input
$location = filter_input(INPUT_POST, "location", FILTER_SANITIZE_STRING); // Sanitize string input
$guests = filter_input(INPUT_POST, "guests", FILTER_VALIDATE_INT); // Validate as integer
$special_occasion = filter_input(INPUT_POST, "special_occasion", FILTER_SANITIZE_STRING); // Sanitize string input
$dessert1 = filter_input(INPUT_POST, "dessert1", FILTER_SANITIZE_STRING); // Sanitize string input
$dessert1_quantity = intval($_POST['dessert1_quantity']); // Convert to integer
$dessert2 = filter_input(INPUT_POST, "dessert2", FILTER_SANITIZE_STRING); // Sanitize string input
$dessert2_quantity = intval($_POST['dessert2_quantity']); // Convert to integer
$dessert3 = filter_input(INPUT_POST, "dessert3", FILTER_SANITIZE_STRING); // Sanitize string input
$dessert3_quantity = intval($_POST['dessert3_quantity']); // Convert to integer
$dessert4 = filter_input(INPUT_POST, "dessert4", FILTER_SANITIZE_STRING); // Sanitize string input
$dessert4_quantity = intval($_POST['dessert4_quantity']); // Convert to integer
$event_description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING); // Sanitize string input

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO form (name, email, event_date, location, guests, special_occasion, dessert1, dessert1_quantity, dessert2, dessert2_quantity, dessert3, dessert3_quantity, dessert4, dessert4_quantity, event_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die('Error preparing SQL statement: ' . $conn->error);
}

// Bind parameters
$result = $stmt->bind_param('ssssssssisiiiss', $name, $email, $event_date, $location, $guests, $special_occasion, $dessert1, $dessert1_quantity, $dessert2, $dessert2_quantity, $dessert3, $dessert3_quantity, $dessert4, $dessert4_quantity, $event_description);

if (!$result) {
    die('Error binding parameters: ' . $stmt->error);
}

// Execute SQL statement
$result = $stmt->execute();

if (!$result) {
    die('Error executing SQL statement: ' . $stmt->error);
}

// Close the database connection
$stmt->close();
$conn->close();

// Redirect to a success page or display a success message
header("Location: success.php");
exit();


?>



