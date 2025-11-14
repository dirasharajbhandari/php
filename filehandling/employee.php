<?php //createTable.php
require ('connection.php');
$sql = "CREATE TABLE employees (
    empID INT AUTO_INCREMENT PRIMARY KEY,
    empName VARCHAR(255),
    position VARCHAR(100),
    salary DECIMAL(10,2),
    department VARCHAR(100)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'employee' created successfully!";
} else {  echo "Error creating table: " . $conn->error; }
$conn->close();
?>