<?php
session_start(); // Start session if not already started

// Check if user is not logged in as admin, redirect to login page
if(!isset($_SESSION['admin_logged_in'])){
    header('location: alogin.php');
    exit; // Ensure script stops executing after redirection
}

// Include your server connection file
include('../server/connection.php');

// Retrieve catering event form data from the database
$stmt = $conn->prepare("SELECT * FROM form");
$stmt->execute();
$result = $stmt->get_result();

// Fetch and display the catering event form data
$catering_forms = $result->fetch_all(MYSQLI_ASSOC);

if(isset($_POST['create_admin_btn'])){
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    // Hash password
    $hashed_password = md5($admin_password);

    // Prepare and execute SQL query to insert new admin account
    $stmt = $conn->prepare("INSERT INTO admin (admin_name, admin_email, admin_password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $admin_name, $admin_email, $hashed_password);
    $stmt->execute();

    // Set success message
    $_SESSION['admin_create_success'] = "New admin created successfully.";

    // Redirect back to dashboard after creating the admin account
    header('location: dashboard.php');
    exit; // Ensure script stops executing after redirection
}




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventful Eats - Catering Services</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
                <li><a class="active" href="../index.php">Home</a></li>
                <li><a href="../shop.html">Shop</a></li>
                <li><a href="../about.html">About</a></li>
                <li><a href="../contact.html">Contact</a></li>
                <li><a href="../login.php">Login</a></li>
                <li><a href="../checkout.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>




<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Add your navigation links here -->
      </ul>
      <form class="d-flex" action="logout.php" method="POST">
        <button class="btn btn-outline-danger" type="submit" name="logout_btn">Logout</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['admin_name']; ?></h2>
    
    <!-- Display success message if new admin is created successfully -->
    <?php if(isset($_SESSION['admin_create_success'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['admin_create_success']; ?>
    </div>
    <?php unset($_SESSION['admin_create_success']); // Clear the success message ?>
    <?php endif; ?>

    <!-- Form for creating new admin account -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Create New Admin Account</h3>
            <form id="create-admin-form" method="POST" action="dashboard.php">
                <div class="form-group">
                    <label for="admin_name">Admin Name</label>
                    <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                </div>
                <div class="form-group">
                    <label for="admin_email">Admin Email</label>
                    <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                </div>
                <div class="form-group">
                    <label for="admin_password">Admin Password</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="create_admin_btn">Create Account</button>
            </form>
        </div>
    </div>

    <!-- Display catering event form data -->
    <div class="mt-4">
        <h3>Catering Event Forms</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date and Time of Event</th>
                    <th>Location</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($catering_forms as $form): ?>
                <tr>
                    <td><?php echo $form['name']; ?></td>
                    <td><?php echo $form['email']; ?></td>
                    <td><?php echo $form['event_date']; ?></td>
                    <td><?php echo $form['location']; ?></td>
                    <!-- Display more form data here -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
<h2>Placed Orders</h2>
    <?php

    // Retrieve orders from the database
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Order ID</th><th>Order Date</th><th>Details</th></tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["order_date"] . "</td>";
            echo "<td><a href='../order_details.php?order_id=" . $row["order_id"] . "'>View Details</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No orders found.";
    }

    // Close the database connection
    $conn->close();

    ?>

    

<footer class="section-p1">
        <div class="col">
            <h4>Contact</h4>
            <p>Address: University, MS 38677 </p>
            <p>Phone: (662) 915-7211</p>
            <p>Hours: 9am - 9pm, Mon - Sun</p>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="../about.html">About Us</a>
            <a href="../forms.php">Catering Services</a>
            <a href="../contact.html">Contact Us</a>
            <a href="../alogin.php">Admin Login</a>
        </div>
        <div class="copyright">
            <p>© 2024 Eventful Eats. All rights reserved.</p>
        </div>
    </footer>
</body>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
