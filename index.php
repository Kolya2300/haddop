<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Car Sale</title>
</head>
<body>
  <h1>Welcome to Car Sale!</h1>
  <p><a href="add_car.php">Add a Car</a></p>
  <p><a href="view_cars.php">View Cars</a></p>
  <p><a href="edit_portfolio.php">Edit Portfolio</a></p>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>

