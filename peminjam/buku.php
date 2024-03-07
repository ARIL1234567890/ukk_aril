<?php
$conn = $data->getConnection();

function isInCollection($userId, $bukuId, $conn){
    $query = "SELECT BukuID, UserID FROM koleksipribadi WHERE UserID=? AND BukuID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $bukuId);
    $stmt->execute();
    $result = $stmt->get_result();

    return mysqli_num_rows($result) > 0;
}
?>
<div class="row justify-content-center">
<?php foreach($getData as $row) :  
    $userId = $_SESSION['login']['UserID'];
    $bukuId = $row['BukuID'];
?>
    <div class="card mx-1 mt-2" style="width: 18rem;">
    <!-- <img src="../assets/image/404.jpg" class="card-img-top mt-1" alt=".."> -->
      <div class="card-body d-flex flex-column justify-content-between">
        <div>
          <h5 class="card-title"><?= $row["Judul"] ?></h5>
          <p class="card-text text-truncate"><?= $row["Deskripsi"] ?></p>
        </div>
          <div class="mt-3 d-flex">
            <a href="?page=peminjaman&id=<?= $bukuId ?>" class="btn btn-primary w-100">Lihat <i class="bi bi-eye-fill ms-1"></i></a>
            <?php if(isInCollection($userId, $bukuId, $conn)) : ?>
                <button type="button" id="removeBuku<?= $bukuId ?>" onclick="addCollection(<?= $bukuId ?>, <?= $userId ?>, 2)" class="btn btn-primary w-9 ms-1"><i class="bi bi-bookmark-dash"></i></button>
                <button type="button" id="addBuku<?= $bukuId ?>" onclick="addCollection(<?= $bukuId ?>, <?= $userId ?>, 1)" class="btn btn-outline-primary w-9 ms-1" style="display:none"><i class="bi bi-bookmark"></i></button>
            <?php else : ?>
                <button type="button" id="removeBuku<?= $bukuId ?>" onclick="addCollection(<?= $bukuId ?>, <?= $userId ?>, 2)" class="btn btn-primary w-9 ms-1" style="display:none"><i class="bi bi-bookmark-dash"></i></button>
                <button type="button" id="addBuku<?= $bukuId ?>" onclick="addCollection(<?= $bukuId ?>, <?= $userId ?>, 1)" class="btn btn-outline-primary w-9 ms-1"><i class="bi bi-bookmark"></i></button>
            <?php endif; ?>
          </div>
      </div>
    </div>
<?php endforeach; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function addCollection(bukuId, userId, status){
      $.ajax({
        url: 'koleksi.php',
        type: 'post',
        data: 
        {
          bukuId : bukuId,
          userId : userId,
          status : status
        },
        success: function(response){
          // Menguraikan respons JSON menjadi objek JavaScript
          var data = JSON.parse(response);

          if(data == 1){
            $('#removeBuku' + bukuId).show();
            $('#addBuku' + bukuId).hide();
          }else{
            $('#removeBuku' + bukuId).hide();
            $('#addBuku' + bukuId).show();
          }
        }
      })
    }
</script>
