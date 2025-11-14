<?php
require 'connection.php';
$sql = "SELECT city, COUNT(*) AS total_people FROM persons GROUP BY city";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo $row["city"] . " - " . $row["total_people"] . " people<br>";
  }
} else {
  echo "No data found";
}
$conn->close();
?>