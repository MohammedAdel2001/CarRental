<?php
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}

// Replace these details with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    // Use prepared statement to update the car status
    $sqlUpdate = $conn->prepare("UPDATE car SET status = 'reserved' WHERE id = ?");
    
    // Bind the parameter
    $sqlUpdate->bind_param("i", $carId);

    

    // Close the prepared statement
    $sqlUpdate->close();
} else {
    echo "Invalid request. Car ID not provided.";
}



// Close the database connection
$conn->close();
?>