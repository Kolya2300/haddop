<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}

$db = new mysqli("localhost", "kolya", "root", "car_sale");
$query = "SELECT * FROM cars";
$result = $db->query($query);

?>

<!DOCTYPE html>
<html>
<head>
  <title>View Cars</title>
</head>
<body>
  <h1>View Cars</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>Make</th>
      <th>Model</th>
      <th>Year</th>
      <th>Price</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["make"]; ?></td>
        <td><?php echo $row["model"]; ?></td>
        <td><?php echo $row["year"]; ?></td>
        <td><?php echo $row["price"]; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <p><a href="index.php">Back to Home</a></p>
</body>
</html>

