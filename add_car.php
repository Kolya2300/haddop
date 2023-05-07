<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}

$message = "";

if(isset($_POST["make"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["price"])){
  $make = $_POST["make"];
  $model = $_POST["model"];
  $year = $_POST["year"];
  $price = $_POST["price"];

  $db = new mysqli("localhost", "kolya", "root", "car_sale");
  $query = "INSERT INTO cars (make, model, year, price) VALUES ('$make', '$model', $year, $price)";
  $result = $db->query($query);

  if($result){
    $message = "Car added successfully!";
  } else {
    $message = "Error adding car.";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Car</title>
</head>
<body>
  <h1>Add Car</h1>
  <?php echo $message; ?>
  <form method="post">
    <label for="make">Make:</label>
    <input type="text" name="make" required><br>
    <label for="model">Model:</label>
    <input type="text" name="model" required><br>
    <label for="year">Year:</label>
    <input type="number" name="year" required><br>
    <label for="price">Price:</label>
    <input type="number" name="price" required><br>
    <input type="submit" value="Add">
  </form>
  <p><a href="index.php">Back to Home</a></p>
</body>
</html>

