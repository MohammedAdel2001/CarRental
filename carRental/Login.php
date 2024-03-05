<?php
session_start();

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if admin checkbox is selected
    if (isset($_POST["login_as_admin"])) {
        $table = "admin";
    } else {
        $table = "customers";
    }

    // Verify login credentials
    $sql = "SELECT * FROM $table WHERE username = '$username'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password === $row["password"]) {
            // Login successful
            $_SESSION["username"] = $username;
            $_SESSION["CustomerID"] = $row["id"];

            if ($table === "admin") {
                header("Location: AdminHomePage.php");
            } else {
                header("Location: CustomerHomePage.php");
            }
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}
// Close the database connection
$conn->close();
?>


<!-- HTML Form -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="style2.css" />
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label><br />
            <input type="text" id="username" name="username" required /><br />
            <label for="password">Password:</label><br />
            <input type="password" id="password" name="password" required /><br />

            <p>Login as:</p>
            <label><input type="checkbox" name="login_as_admin" /> Admin </label>
            <label><input type="checkbox" name="login_as_customer" /> Customer </label><br />

            <button type="submit">Login</button>
        </form>

        <p>
            Doesn't have an account ?
            <a href="Register.php">Register here</a>
        </p>
    </div>
</body>
</html>