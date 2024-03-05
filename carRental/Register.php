<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Create Your Account</h1>
        <p>Enter your details to sign up.</p>
        <form action="databaseConnection.php" method="post">
            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="phoneNumber">Phone Number:</label><br>
            <input type="tel" id="phoneNumber" name="phoneNumber"><br>
            <button type="submit">Sign Up</button>

        </form>
        <p>Already have an account? <a href="Login.php">Log in here</a></p>
    </div>
</body>

</html>