<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>example of multiple</h1>

    <?php

   for($i=1;$i<=10;$i++)
   {
    $result=5*$i;

    echo "5  * $i = " . $result; //. is used for concatination

    printf("\n");
    
     if($result>30)
         {
     echo "result is too big";
        }
   }
    ?>

</body>
</html>