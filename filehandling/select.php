<?php
require('connection.php');

$result=$conn->query("SELECT name,age FROM student");
while($row=$result->fetch_assoc())
{
    echo $row["name"]."-".$row["age"]."<br>";
}

?>