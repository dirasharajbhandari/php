<?php
//global variable declared outside the function
$a=5;
$b=4;
function sum()
{
global $a; //this line is important
global $b;

$sum=$a+$b;
//alternative $sum = GLOBALS['a']+GLOBALS['b'];

echo "The sum is:".$sum;
}
sum();
?>