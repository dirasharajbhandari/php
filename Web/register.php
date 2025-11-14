<?php
include("dbms.php");
if(isset($_POST['login']))
{
$ID = $_POST['ID']; 
$username = $_POST['username'];
$password = $_POST['password'];
$qry = "select * from login where username='$username' and
password='$password'";
$result = mysqli_query($connection,$qry);
$selectedUser = mysqli_num_rows($result);
if($selectedUser>0)
{
session_start();
$_SESSION['Username']=$Username;
header("location:welcome.php");
mysqli_close($connection);
exit;
}
else
{
echo "User name or password not matched";
mysqli_close($connection);
exit;
}
}