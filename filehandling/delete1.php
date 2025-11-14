<?php
require 'connection.php';
$sql = "DELETE FROM persons WHERE fullName='Ram Khan'";
if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully!";
} else {
  echo "Error deleting record: " . $conn->error;
}
$conn->close();
?>