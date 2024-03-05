<!DOCTYPE html>
<html>
<head>
    <title>Fill The Following Form</title>
    
</head>
<body>
        <form action="CarRental.php" method="post">
            <label for="EndDate">EndDate:</label><br>
            <input type="date" id="EndDate" name="EndDate" placeholder="today"><br>
            
            <label for="rent"> Are You Sure You Want To Rent ?</label><br>
            <input id="rent" type="submit" value="Rent">
        </form>
</body>
</html>

<?php

   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "carrental";
   $customerID = $_SESSION["CustomerID"];
   $carId = $_SESSION["carId"];
   $Price=$_SESSION["Price"];
   
   
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $EndDate = $_POST["EndDate"];
      
       
        
       
    
       
        $startdate = new DateTime( date("Y-m-d"));
        $enddate = new DateTime($EndDate);
        $interval = $startdate->diff($enddate);
        $days = $interval->days;

        $TotalCost= $days * $Price; 
       
      

        
   
       $sql = "INSERT INTO rentalcar (EndDate,TotalCost,CustomerID,CarID) VALUES ('$EndDate', '$TotalCost','$customerID','$carId')";
   
       if ($conn->query($sql) === TRUE) {
           echo "Successfully Rented";
       } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
 }
}
?>