<?php
$connection = mysqli_connect("127.0.0.1:3307","root","","parking");
if(!$connection)

{
 	die("not connected!!".mysqli_connect_error());
}
else
{
	echo "connected";
}
?>


