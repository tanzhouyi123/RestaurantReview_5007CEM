<?php

//$db_name = 'mysql:host=localhost;dbname=res_db';
//$user_name = 'root';
//$user_password = '';

$servername = 'localhost';
$username = 'root';
$passwrod = "";
$database = 'res_db';
try {
$conn= new PDO("mysql:host=localhost;dbname=res_db",$username,$passwrod);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {  
    echo "Error: " . $e->getMessage();
}
?>