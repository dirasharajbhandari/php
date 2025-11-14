<?php
$a=89;
$b=21;
$sum=$a+$b;
$sub=$a-$b;
$mux=$a*$b;
$div=$a/$b;
echo "The sum of two number is:.$sum"."<br>";
echo "The difference between two number is:.$sub"."<br>";
echo "The multiplication of two number is:.$mux"."<br>";
echo "The division is:.$div"."<br>";

if($sum<$sub)
{
echo "The value for sum is less than the value of $sub";
}
else
{
echo "The value of sub is less than the value of $sum";
} 

?>

