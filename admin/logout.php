

<?php
session_start(); // Start session if not already started

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page after logout
header("location: alogin.php");
exit; // Ensure script stops executing after redirection
?>
