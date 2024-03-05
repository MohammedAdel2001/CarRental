<?php
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION["username"];

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

// Retrieve data from the 'car' table
$sql = "SELECT * FROM car";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
    <!-- Additional styles for cards (customize as needed) -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .card {
            flex: 0 0 calc(33.33% - 20px);
            box-sizing: border-box;
            margin: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card img {
            max-width: 250px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .reserve-button {
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
    <br>
    <h1>
        Welcome to our car rental website!
    </h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="container">
                <div class="card">
                    <?php $_SESSION["carId"] = $row["id"]?>
                    
                     <?php $_SESSION["Price"] = $row["price"]?>
                    <img src="<?php echo $row["image_path"]; ?>" alt="Car Image">
                    <h2>Model:
                        <?php echo $row["Model"]; ?>
                    </h2>
                    <p>Plate ID:
                        <?php echo $row["plate_id"]; ?>
                    </p>
                    <p>Year:
                        <?php echo $row["year"]; ?>
                    </p>
                    <p>Price:
                        <?php echo $row["price"] . " EGP"; ?>
                    </p>
                    <p>Status:
                        <?php echo $row["status"]; ?>
                        
                    </p>
                    <button class="reserve-button" onclick="reserveCar(<?php echo $row['id']; ?>)">Reserve</button>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No cars available.";
    }
    ?>
    <a class="reserve-button" href="logout.php">Logout</a>

    
    <script>
    function reserveCar() {
    
    window.location.href = 'CarRental.php';
        }
</script>
</body>

</html>