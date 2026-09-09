<?php


$num = 4;


if($num >0){
    echo "$num is greater than 0";
}



$age = 14;


echo "<br>";
if(($age > 12) && ($age < 20)) {
    echo "You are a teenager";
}


echo "<br>";
$age = 19;
if ($age < 18) {
    echo "You are under 18";
}else{
    echo "You are an adult";
}


$number = 1;
if($number < 0){
    echo "The value of $number os a negative number";
}elseif($number == 0){
    echo "The value of $number is a zero";
}else{
    echo "The value of $number is a positive number";
}

echo "<br>";

$number = 3;
if($number < 0){
    echo "The value of $number os a negative number";
}elseif($number == 0){
    echo "The value of $number is a zero";
}else{
    echo "The value of $number is a positive number";
}




?>