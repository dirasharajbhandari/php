<?php
// Connect to the database
require('dbms.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        nav a { margin-right: 10px; }
    </style>
</head>
<body>
    <div class="form">
        <!-- Navigation Links -->
        <nav>
            <a href="index.php">Home</a> |
            <a href="insert.php">Insert New Record</a> |
            <a href="view.php">View Records</a> |
            <a href="login.php">Login</a>
        </nav>

        <h2>View Registered Users</h2>

        <!-- Table to display records -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Vehicle</th>
                    <th>Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

<?php
$count = 1;
$sql_query = "SELECT * FROM register ORDER BY first DESC;";
$result = mysqli_query($connection, $sql_query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?php echo $count++; ?></td>
        <td><?php echo htmlspecialchars($row["First"]); ?></td>
        <td><?php echo htmlspecialchars($row["Middle"]); ?></td>
        <td><?php echo htmlspecialchars($row["Last"]); ?></td>
        <td><?php echo htmlspecialchars($row["Email"]); ?></td>
        <td><?php echo htmlspecialchars($row["Contact"]); ?></td>
        <td><?php echo htmlspecialchars($row["Address"]); ?></td>
        <td><?php echo htmlspecialchars($row["Vehicle"]); ?></td>
        <td><?php echo htmlspecialchars($row["Time"]); ?></td>
        <td><a href="edit.php?id=<?php echo $row["First"]; ?>">Edit</a></td>
        <td><a href="delete.php?id=<?php echo $row["First"]; ?>">Delete</a></td>
    </tr>
<?php
}
?>
            </tbody>
        </table>
    </div>
</body>
</html>
