<?php //insert.php
require ('connection.php');
$sql = "INSERT INTO persons (fullName, address, city)
        VALUES ('Ramooo Khan', 'Kalimati', 'pokhara')";
if ($conn->query($sql) === TRUE) {
    echo "New record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>