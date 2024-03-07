<?php
require 'action.php';

$conn = new Connection();
$connection = $conn->getConnection();

$bukuId = $_POST['bukuId'];
$userId = $_POST['userId'];

if($_POST['status'] == '2'){
    $query = "DELETE FROM koleksipribadi WHERE BukuID=? AND UserID=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $bukuId, $userId);
    $stmt->execute();

    $stmt->close();
    $connection->close();

    echo json_encode(2); // Mengirim respons JSON bahwa penghapusan berhasil
    exit; // Keluar dari skrip PHP
}

// Menjalankan kueri untuk menambahkan data ke dalam database
$query = "INSERT INTO koleksipribadi (UserId, BukuId) VALUES (?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $userId, $bukuId);
$stmt->execute();

$stmt->close();
$connection->close();

echo json_encode(1); // Mengirim respons JSON bahwa penambahan berhasil