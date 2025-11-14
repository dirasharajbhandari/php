<?php
$student =array('dirasha','sita','gita');
$arrlength=count($student);
echo "list of students using for loop is: </br>";
for($i=0;$i<$arrlength;$i++)
{
    echo $student[$i];
    echo "<br>";
}
?>