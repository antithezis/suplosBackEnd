<?php
require_once("./db.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $guardarBien = $connection->prepare("UPDATE bien SET guardado = 1 WHERE id = '$id'");
    $guardarBien->execute();

    header("Location: index.php");
    exit();
}

?>

