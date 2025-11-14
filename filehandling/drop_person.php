<?php
require ‘connection.php’;

$sql = "DROP TABLE persons";
if ($conn->query($sql) === TRUE) {
  echo "Table dropped successfully!";
} else {
  echo "Error dropping table: " . $conn->error;
}

$conn->close();
?>