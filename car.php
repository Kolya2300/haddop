<?php
session_start();

// check if user is logged in
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}

// get car id from url parameter
if(!isset($_GET["id"])){
  header("Location: cars.php");
  exit();
}
$car_id = $_GET["id"];

// get car details from database
$db = new mysqli("localhost", "kolya", "root", "car_sale");
$car_query = "SELECT * FROM cars WHERE id=$car_id";
$car_result = $db->query($car_query);
if($car_result->num_rows == 0){
  header("Location: cars.php");
  exit();
}
$car = $car_result->fetch_assoc();

// handle form submission
$message = "";
if(isset($_POST["submit"])){
  $buyer_name = $_POST["buyer_name"];
  $buyer_email = $_POST["buyer_email"];
  $buyer_phone = $_POST["buyer_phone"];

  // insert order into database
  $insert_query = "INSERT INTO orders (car_id, buyer_name, buyer_email, buyer_phone) 
                   VALUES ($car_id, '$buyer_name', '$buyer_email', '$buyer_phone')";
  if($db->query($insert_query)){
    // redirect to thank you page
    header("Location: thank_you.php");
    exit();
  } else {
    $message = "Error placing order. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order - Car Sale</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Order</h1>
    <p>Please fill in your details to purchase the following car:</p>
    <h2><?php echo $car["make"] . " " . $car["model"]; ?></h2>
    <p>Price: $<?php echo $car["price"]; ?></p>
    
    <form method="post" style="
    display: flex;
    flex-direction: column;
    width: 231px;
    margin: 0 auto;
">
      <label for="buyer_name">Your Name:</label>
      <input type="text" id="buyer_name" name="buyer_name" required>
      
      <label for="buyer_email">Your Email:</label>
      <input type="email" id="buyer_email" name="buyer_email" required>
      
      <label for="buyer_phone">Your Phone Number:</label>
      <input type="tel" id="buyer_phone" name="buyer_phone" required>

      <input type="submit" name="submit" value="Purchase">
    </form>

    <div class="message"><?php echo $message; ?></div>
    <a href="cars.php">Back to Home</a>
  </div>
</body>
</html>
