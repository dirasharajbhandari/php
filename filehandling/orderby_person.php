<?php
require 'connection.php';
$sql = "SELECT * FROM persons ORDER BY fullName DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo $row["personID"] . " - " . $row["fullName"] . " - " . $row["city"] . "<br>";
  }
} else {
  echo "No records found";
}
$conn->close();
?>