<?php //insertEmployee.php
require('connection.php');

$sql = "INSERT INTO employees (empName, position, salary, department)
        VALUES ('Sita Sharma', 'Manager', 55000.00, 'HR')";

if ($conn->query($sql) === TRUE) {
    echo "New employee record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
