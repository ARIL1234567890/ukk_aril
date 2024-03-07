<?php

require_once "action.php";

$conn = new Connection();

$query = mysqli_query($conn->getConnection(), "SELECT buku.BukuID, buku.Judul, buku.Deskripsi FROM koleksipribadi LEFT JOIN buku ON buku.BukuID = koleksipribadi.BukuID");

$row = [];
while($result = mysqli_fetch_assoc($query)){
    $row[] = $result;
}

if($row == NULL){
    echo "<h6 style='display:flex; justify-content:center; margin-top:25dvh'>Anda tidak mempunyai koleksi pribadi, silahkan &nbsp;<a href='?page=buku'>tambah koleksi</a></h6>";
}

?>

<div class="row justify-content-center">
<?php 
    foreach($row as $rows) :  
    $userId = $_SESSION['login']['UserID'];
    $bukuId = $rows['BukuID'];
?>
    <div class="card mx-1 mt-2" style="width: 18rem;">
       <center>
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
            <h5 class="card-title"><?= $rows["Judul"] ?></h5>
            <p class="card-text text-truncate"><?= $rows["Deskripsi"] ?></p>
            <a href="?page=peminjaman&id=<?= $bukuId ?>">Detail</a>
            </div>
    
            <div class="mt-3 d-flex">
                <a href="?page=hapus-koleksi&buku=<?= $bukuId ?>&user=<?= $userId ?>" class="btn btn-primary w-100 ms-1" onclick="return confirm('Hapus dari koleksi pribadi')"><i class="bi bi-bookmark-dash"></i></a>
            </div>
        </div>
    </div>
    </center>
<?php endforeach; ?>
</div>