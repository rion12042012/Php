<?php
$host = "localhost";
$user = "root";
$pass = "";


try{

    $conn = new PDO("mysql :host=$host;", $user, $pass);

    $sql = "CREATE TABLE test(id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL)";

    $conn->exec($sql);

    echo"Table is created";

}catch(Exception $e){

echo "not conncted".$e->getMessage();


}




?>