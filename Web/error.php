<?php
if(!file_exists("text.txt"))
{
die("File not found");//this is die method
}
else
{
$file=fopen("text.txt","r");
}
?>