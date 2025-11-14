<?php //select.php
require ('connection.php');
// $sql = "SELECT * FROM persons";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//     echo "ID: " . $row["personID"] . " | Name: " . $row["fullName"] .
//          " | Address: " . $row["address"] . " | City: " . $row["city"] . "<br>";
//   }
// } else {
//   echo "No records found.";
// }

$sql = "SELECT COUNT(fullname) AS total FROM persons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "The result is: " . $row['total'];
} else {
    echo "No data found.";
}

$conn->close();

?>