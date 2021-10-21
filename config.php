<?php
       //database parameters
       $host = "localhost";
       $dbname   = "testassignment";
       $user   = "smeechy";
       $password   = "Beanaldo_0615";

       
//setting DSN
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

//creating a PDO instance
try{
    $pdo = new PDO($dsn,$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}catch(PDOException){
    echo $e->getMessage();
}

?>