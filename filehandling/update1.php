<?php
require 'connection.php';
$sql = "UPDATE persons 
        SET address = 'New Baneshwor', city = 'Lalitpur'
        WHERE fullName = 'Ramooo Khan'";
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully!";
} else {
  echo "Error updating record: " . $conn->error;
}
$conn->close();
?>