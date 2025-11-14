<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>switch system for the day display</h1>

<?php

$input="monday";

switch($input)
{
    case "sunday":
        echo "1.sunday";
        break;

    case "monday":
        echo "2.monday";
        break;

    case "tuesday":
        echo "3.tuesday";
        break;

    case "wednesday":
        echo "4. wednesday";
        break;
        
    default:
    echo "invalid";
}
    
    ?>
</body>
</html>