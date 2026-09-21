<?php



  //Built-in Functions


 //phpinfo();


 $x = "Hello";
 print_r($x);


 echo "<br>";



 $a = 5;
 echo gettype($a) . "<br>";


 $b = 10.3;
 echo gettype($b) . "<br>";


 $c = "Hi";
 echo gettype($c) . "<br>";


//User-defined functions


 function display(){
    echo "this is PHP version: " . phpversion();
    echo "<br>";
 }


 display();


function hello(){
    echo "Hello World";
    echo "<br>";
}
hello();


function sum(){
    $value = 120 + 20;
    echo $value;
    echo "<br>";
}


sum();

function shuma($x,$y){
    $value = $x + $y;
    echo $value;
    echo "<br>";


}



shuma(12,40);



function maximum($a,$b) {
    if($a > $b){
        return $a;
    }else{
        return $b;
    }


}
 $a = 10;
 $b = 30;


$test = maximum(10,30);
echo "The max of $a and $b is $test";
echo "<br>";



$z = 5;//global variable


function localVariable() {
    $h = 10; // local variable
    //echo $z;
    echo $h;
    global $z;
    echo "<br>";
    echo $z;


}


localVariable();


echo "<br>";




function callCounter(){
    static $count = 0;
    $count++; //1
    echo "The value of count is: $count";
    echo "<br>";
}


callCounter(); //count=1
callCounter();
echo "<br>";
echo "<br>";
echo "<br>";

// $sports = array("Football","Vollejboll","Tenis","Handboll"); //menyra e pare

$Sports = ["Football","Vollejboll","Tenis","Handboll","Basketball","Kayak"];

echo $Sports[0];


echo "<br>";
echo end($Sports);
echo "<br>";
echo count($Sports);
echo "<br>";
echo "<br>";

array_push($Sports, "Skiing");
array_unshift($Sports,"Golf");

echo "<br>";
echo count($Sports);
for($i=0;$i < 8 ;$i++){
    echo $Sports[$i];
    echo "<br>";
}






array_shift($Sports); // - removes the first item
array_pop($Sports);  //- removes the last item
echo "<br>";
echo "<br>";
echo "<br>";

for($i=0;$i < 6 ;$i++){
    echo $Sports[$i];
    echo "<br>";
}

echo "<br>";
var_dump($Sports);

$output1 = array_slice($Sports,2);
$output2 = array_slice($Sports,0,3);
echo "<br>";
var_dump($output1);
echo "<br>";
var_dump($output2);

?>


