<?php //createTable.php
require ('school_db.php');
$sql = "CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(100),
    age INT,
    city VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'students' created successfully!";
} else {  echo "Error creating table: " . $conn->error; }
$conn->close();
?>