<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h1>this is the eaxmple for printing</h1>
   
   <?php


   for($i=1;$i<=20;$i++)
   {
    echo $i;
   }
   print("\n");
   for($i=1;$i<20;$i++)
   {
    if($i % 2 === 0)
    {
        echo "EVEN : $i";
    }
   }
   ?>
</body>
</html>