<?php
require_once "action.php";

$conn = new Connection();

$buku = $_GET["buku"];
$user = $_GET["user"];

$query = mysqli_query($conn->getConnection(), "DELETE FROM koleksipribadi WHERE UserID='$user' AND BukuID='$buku'");

if($query){
    exit(header("location:" . $_SERVER['HTTP_REFERER']));
}