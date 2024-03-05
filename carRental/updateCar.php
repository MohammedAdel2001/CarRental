<!-- updateCar.php -->
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
    
    // Get updated details from the form
    $updatedModel = $_POST['model'];
    $updatedPlateId = $_POST['plate_id'];
    $updatedYear = $_POST['year'];
    $updatedPrice = $_POST['price'];
    $updatedStatus = $_POST['status'];

    // Update the car details in the database
    $updateSql = "UPDATE car 
                  SET Model = '$updatedModel', plate_id = '$updatedPlateId', year = '$updatedYear',
                      price = '$updatedPrice', status = '$updatedStatus'
                  WHERE id = '$carId'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Car details updated successfully!";
    } else {
        echo "Error updating car details: " . $conn->error;
    }
}

// Get the car ID from the URL parameter
if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    // Retrieve car details
    $carSql = "SELECT * FROM car WHERE id = '$carId'";
    $carResult = $conn->query($carSql);

    if ($carResult->num_rows > 0) {
        $carRow = $carResult->fetch_assoc();
    } else {
        echo "Car not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .button {
            background-color: #007BFF;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome,
            <?php echo $_SESSION["username"]; ?>!
        </h1>
        <h2>Update Car Details:</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="car_id" value="<?php echo $carRow['id']; ?>">
            <label for="model">Model:</label>
            <input type="text" name="model" value="<?php echo $carRow['Model']; ?>" required>

            <label for="plate_id">Plate ID:</label>
            <input type="text" name="plate_id" value="<?php echo $carRow['plate_id']; ?>" required>

            <label for="year">Year:</label>
            <input type="text" name="year" value="<?php echo $carRow['year']; ?>" required>

            <label for="price">Price:</label>
            <input type="text" name="price" value="<?php echo $carRow['price']; ?>" required>

            <label for="status">Status:</label>
            <input type="text" name="status" value="<?php echo $carRow['status']; ?>" required>

            <input type="submit" value="Update">
        </form>

        <br>

        <form method="post" action="deleteCar.php">
            <input type="hidden" name="car_id" value="<?php echo $carRow['id']; ?>">
            <input type="submit" value="Delete Car">
        </form>

        <br>

        <p><a href="AdminHomepage.php">Back to Admin Homepage</a></p>
    </div>
</body>

</html>

<?php
$conn->close();
?>
