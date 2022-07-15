<?php 

$host = "localhost";
$db = "intelcost_bienes";
$user = "root";
$password = "";

try {
    $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    //if($connection){echo "melos";}
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>