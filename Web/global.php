<?php

//global varibale is declared inside the function

function sum()
{
global $a;
$a=5;
global $b;
$b=4;
$sum=$a+$b;
echo "Global declared with in a function the sum of two no is:".$sum;
}
sum();
?>