<!-- AdminHomepage.php -->
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

// Retrieve all cars data
$carsSql = "SELECT * FROM car";
$carsResult = $conn->query($carsSql);

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="adminStyle.css" />
</head>

<body>
    <div class="container">
        <h1>Welcome,
            <?php echo $_SESSION["username"]; ?>!
        </h1>

        <h2>All Cars:</h2>
        <table>
            <tr>
                <th>Car ID</th>
                <th>Model</th>
                <th>Plate ID</th>
                <th>Year</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            // Display all cars data
            while ($carRow = $carsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $carRow["id"] . "</td>";
                echo "<td>" . $carRow["Model"] . "</td>";
                echo "<td>" . $carRow["plate_id"] . "</td>";
                echo "<td>" . $carRow["year"] . "</td>";
                echo "<td>" . $carRow["price"] . " EGP</td>";
                echo "<td>" . $carRow["status"] . "</td>";
                echo "<td><a href='updateCar.php?id=" . $carRow['id'] . "'>Update</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <p><a class="button" href="AddCar.php">Add Car</a></p>
        <br>
        <p><a class="button" href="logout.php">Logout</a></p>
    </div>
</body>

</html>

<?php
$conn->close();
?>
