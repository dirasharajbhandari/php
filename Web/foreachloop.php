<?php
//index array using foeeach loop
$person=array("ram","gita","sita");
foreach ($person as $value)
{
echo " $value"."<br>";
}

//associative array using foreach loop
$name=array("ram"=>20,"shyam"=>30);
foreach($name as $type=>$value)
{
echo " [$type]=$value ,";
}

?>