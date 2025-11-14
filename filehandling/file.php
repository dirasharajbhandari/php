<?php

$filename="example.txt";

$file=fopen($filename,"w");
fwrite($file,"hello im dirasha\n");
fwrite($file,"hello again\n");
fclose($file);

$file=fopen($filename,"r");
$size=filesize($filename);
$content=fread($file,$size);
echo $content;
fclose($file);

$file=fopen($filename,"a");
fwrite($file,"adding new text at the end of the file.\n");
fclose($file);

$file=fopen($filename,"r");
$updatedContent=fread($file,filesize($filename));
fclose($file);

if(file_exists($filename))
{
    unlink($filename);

    echo"<b>Step5:</b> file deleted succesfully.<br>";
}
else
{
    echo"<b>Step5:</b>File not found!<br>";
}

?>