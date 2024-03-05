<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plateId = $_POST["plate_id"];
    $year = $_POST["year"];
    $imagePath = $_POST["image_path"];
    $price = $_POST["price"];
    $model = $_POST["Model"];

    // Insert data into the "cars" table
    $sql = "INSERT INTO car (Model, plate_id,year,image_path, price) VALUES ('$model' ,'$plateId', '$year', '$imagePath', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Car added successfully!";
    } else {
        echo "Error adding car: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Car</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <h1>Add Car</h1>
      <form action="addCar.php" method="post">
        <label for="Model">Car Model:</label><br />
        <input type="text" id="Model" name="Model" required /><br />

        <label for="plate_id">Plate ID:</label><br />
        <input type="text" id="plate_id" name="plate_id" required /><br />

        <label for="year">Year:</label><br />
        <input type="text" id="year" name="year" required /><br />

        <label for="image_path">Image URL (path):</label><br />
        <input type="text" id="image_path" name="image_path" required /><br />

        <label for="price">Price:</label><br />
        <input type="text" id="price" name="price" required /><br />

        <button type="submit">Add Car</button>
        <p><a href="AdminHomepage.php">Back to Admin Homepage</a></p>

      </form>
    </div>
  </body>
</html>
