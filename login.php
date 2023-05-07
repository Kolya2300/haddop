<?php
session_start();

if(isset($_SESSION["username"])){
  header("Location: index.php");
  exit();
}

$message = "";

if(isset($_POST["username"]) && isset($_POST["password"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  $db = new mysqli("localhost", "kolya", "root", "car_sale");
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = $db->query($query);

  if($result->num_rows > 0){
    // Якщо існує користувач з введеним іменем користувача та паролем, створюємо сесію для користувача
    $_SESSION["username"] = $username;
    if($username == 'kov@gmail.com' && $password == '123'){
    // Перенаправляємо користувача на сторінку з захищеним вмістом
    header("Location: index.php");
    exit();}else{
        header("Location: cars.php");
    }
  } else {
    $message = "Invalid username or password.";
}
}?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Car Sale</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <a href="register.php">Register</a>
    </form>
    <div class="message"><?php echo $message; ?></div>
  </div>
</body>
</html>