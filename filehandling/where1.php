<?php //whereclause.php
require ('connection.php');
$sql = "SELECT * FROM persons WHERE city='Kathmandu'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo $row["fullName"] . " - " . $row["city"] . "<br>";
  }
} else {
  echo "No records found in Kathmandu.";
}

$conn->close();
?>