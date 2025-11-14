<?php
$mark = array(
    "ram" => 90,
    "sita" => 85,
    "gita" => 95
);

$key = array_keys($mark);
$length = count($key);

for ($i = 0; $i < $length; $i++) {
    $name = $key[$i];
    echo $name . " scored " . $mark[$name] . '<br>';
}

?>
