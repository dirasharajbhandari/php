<?php
require('dbms.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID not provided.");
}

$id = intval($_GET['id']); // Ensures it's an integer

$stmt = mysqli_prepare($connection, "DELETE FROM register WHERE First = ?");

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "i", $id); // Bind as integer

if (mysqli_stmt_execute($stmt)) {
    header("Location: view.php"); // Redirect after success
    exit();
} else {
    die("Delete failed: " . mysqli_stmt_error($stmt));
}
?>
