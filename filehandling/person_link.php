<?php
require 'connection.php';
$sql = "SELECT fullName 
        FROM persons
        WHERE personID IN (
            SELECT personID FROM employees WHERE salary > 1500
        )";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo $row["fullName"] . "<br>";
  } } else {  echo "No records found"; }
$conn->close();
?>