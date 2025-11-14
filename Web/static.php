<?php

//static variable declare

function a()
{
static $a;
$a=9;
echo "The value is:".$a;
}
a();

?>