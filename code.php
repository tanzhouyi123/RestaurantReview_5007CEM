<?php 
session_start();
//include ('../components/connect.php');
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


if(isset($_POST['save_comment'])){
    $name = $_POST['uname'];
    $rate = $_POST['rate'];
    $comment = $_POST['comment'];
    
    $query = "INSERT INTO comment(name,rating,comment) VALUES (:name, :rating, :comment)";
    $query_run = $conn ->prepare($query);
    
    $data =[
        ':name' => $name,
        ':rating' => $rate,
        ':comment' => $comment 
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute) {    
        $_SESSION['message'] = "Comment successfully";
        header('location: quick_view.php');
        exit(0);
    }else { 
        $_SESSION['message'] = "Comment failed";
        header('location: quick_view.php');
        exit(0);
    }
}


?>