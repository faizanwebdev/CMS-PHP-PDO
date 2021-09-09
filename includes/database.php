<?php 

$host = "localhost";
$user = "root";
$password = "";
$database = "php-pdo-cms";

$dsn = "mysql:host=$host;dbname=$database";

$con = new PDO($dsn, $user, $password);
$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

if(!$con){
    echo "Database Connection Failed";
}
?>