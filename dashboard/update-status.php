<?php
require_once "../connection.php";

$conn = new Connection;

$id = $_GET['id'];


$status = "Kembali";

$sql = "UPDATE peminjaman SET StatusPeminjaman=? WHERE PeminjamanID=?";
$stmt = $conn->getConnection()->prepare($sql);
$stmt->bind_param("si", $status, $id);
$stmt->execute();

exit(header("location:index.php?page=status-peminjaman"));