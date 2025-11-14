<?php //createTable.php
require ('connection.php');
$sql = "CREATE TABLE persons (
    personID INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(255),
    address VARCHAR(255),
    city VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'persons' created successfully!";
} else {  echo "Error creating table: " . $conn->error; }
$conn->close();
?>