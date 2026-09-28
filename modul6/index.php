<?php

 // $my_file = fopen("filet.txt","w");

 // fclose($my_file);

 //fread

 $filename = "file1.txt";
 $file = fopen($filename,"r");

 $filesize = filesize($filename);

 $my_filedate = fread($file,$filesize);
 echo $my_filedate; "<br>";
 fclose($file);



//  $file1 = fopen("myfile.txt","r");
//  while (!feof($file1)) {
//     echo fgets($file1) ."<br>";
//  }

 //fwite

 $my_file1 = fopen("example.txt","w");

 $txt = "computer programing";
 
 fwrite($my_file1,$txt);

 //w+ (read and write only)
 $file2 = fopen("data.txt","w+");
 fwrite($file2, "Welcome to digital school!");


 //a+
 $file3 = fopen("data.txt","a+");
 fwrite($file3,"Rion");
?>
