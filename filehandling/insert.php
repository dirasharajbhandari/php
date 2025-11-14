<?php
require('connection.php');

$sql="INSERT INTO student(id,name,age,course) VALUES(1,'Dirasha',21,'BCA')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>