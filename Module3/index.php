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

//Loops
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


$x = 1;
while($x <= 5){
    echo "The number is: $x <br>";
    $x++;
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
 
 $y = 1;
 do{
    echo "The number is: $y <br>";
    $x++;
 }while($y >= 5);
    
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

 for($z=9; $z <=16; $z++){
    echo "The number is;$z <br>";
 }

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$cars = array("BMW","VW","BYC","RAM","AUDI","FORD","FERRARI");
foreach($cars as $car ){
    echo "$car <br>";
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
  
$age = array("John" => 18, "Michael" => 20, "Joe" => 13);
 foreach($age as $key => $value){
    echo "$key = $value  <br>";
 }
      
?>