<?php
$db = new mysqli("localhost", "kolya", "root", "car_sale");
$query = "SELECT * FROM cars";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Cars - Car Sale</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="car-container">
    <h1>All Cars</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Price</th>
        <th>Details</th>
      </tr>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row["id"]; ?></td>
          <td><?php echo $row["make"]; ?></td>
          <td><?php echo $row["model"]; ?></td>
          <td><?php echo $row["year"]; ?></td>
          <td><?php echo $row["price"]; ?></td>
          <td><a href="car.php?id=<?php echo $row["id"]; ?>">View Details & Buy car</a></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>

