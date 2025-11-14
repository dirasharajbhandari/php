<?php
function myfunction($errno,$errstr)
{
echo "<b>Error:<b>($errno)($errstr)";
echo "This is end of script";
die();
}
set_error_handler('myfunction');//this handles the eoor on myfunction 
//echo "End of script";
echo($test);//error level :2 output ma xa
?>