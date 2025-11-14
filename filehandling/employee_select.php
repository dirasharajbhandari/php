<?php
require('connection.php');

$result = $conn->query("SELECT empName, position, salary, department FROM employees");

while ($row = $result->fetch_assoc()) {
    echo $row["empName"] . " - " . $row["position"] . " - " . $row["salary"] . " - " . $row["department"] . "<br>";
}

$conn->close();
?>
