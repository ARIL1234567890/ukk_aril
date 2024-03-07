<?php

use FontLib\Table\Type\head;

require_once "action.php";

$id = $_GET['categoryID'];
$buku = $_GET['book'];

$conn = new Connection();

try {
    $check = mysqli_query($conn->getConnection(), "SELECT * FROM kategoribuku_relasi WHERE BukuID='$buku'");
    if(mysqli_num_rows($check) < 2){
        exit(header("location:". $_SERVER['HTTP_REFERER']));
    }
    
    mysqli_query($conn->getConnection(), "DELETE FROM kategoribuku_relasi WHERE KategoriBukuID='$id' ");

    exit(header("location:" . $_SERVER['HTTP_REFERER']));
}catch(Exception $e){
    exit(header("location:" . $_SERVER['HTTP_REFERER']));
}