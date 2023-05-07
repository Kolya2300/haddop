<?php
session_start();

if(isset($_SESSION["username"])){
  header("Location: index.php");
  exit();
}

$message = "";

if(isset($_POST["username"]) && isset($_POST["password"])){
  $email = $_POST["username"];
  $password = $_POST["password"];

  $db = new mysqli("localhost", "kolya", "root", "car_sale");
  $check_query = "SELECT * FROM users WHERE username = '$email'";
  $check_result = $db->query($check_query);

  if($check_result->num_rows > 0){
    $message = "Username or email already exists.";
  } else {
    $insert_query = "INSERT INTO users (username, password) VALUES ('$email', '$password')";
    $db->query($insert_query);
    header("Location: login.php");
    exit();
  }
  // Видалено додаткову змінну $message
  $message ='some error';
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - Car Sale</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="login-container" style="display:flex flex-directory: column; width: 300px">
    <h1>Register</h1>
    <form method="post" style="display:flex;flex-direction: column;">
  
      <label>Email:</label>
      <input type="email" name="username" required>
  
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
  
      <input type="submit" value="Register">
    </form>

    <div class="message"><?php echo $message; ?></div>
  </div>
</body>
</html>
