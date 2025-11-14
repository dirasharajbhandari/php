<?php
$students=array(
    array("ram",90,"kathmandu"),
    array("sita",85,"pokhara"),
    array("gita",95,"biratnagar")
);

$rows=count($students);

for($i=0;$i<$rows;$i++)
{
    echo "name: ".$students[$i][0];
    echo ", marks: ".$students[$i][1];
    echo ", city: ".$students[$i][2]. "<br>";
}
?>