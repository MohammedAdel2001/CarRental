<!-- deleteCar.php -->
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the car ID from the form
    $carId = $_POST['car_id'];

    // Use prepared statement to delete the car
    $deleteSql = "DELETE FROM car WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $carId); // Use "i" for integer

    if ($stmt->execute()) {
        echo "Car deleted successfully!";
        header("Location: AdminHomepage.php");
    } else {
        echo "Error deleting car: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>