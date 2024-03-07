<?php
require_once 'action.php';

$buku = $_GET["id"];
$user =  $_SESSION["login"]["UserID"];

$getData = $data->getDataToInsert($buku);

if(isset($_POST["submit"])){
  $success = $data->insertPeminjam($buku, $user, $_POST);

  if($success){
      $file = $getData["File"];
      echo "<script>window.open('../book/$file', '_blank')</script>";
  }
}

if(isset($_POST["submitulasan"])){
  $data->insertUlasan($buku, $user, $_POST);
}

echo isset($_GET["duplicate"]) ?
 '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Buku telah di pinjam
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>' 
: ''?>
<?= isset($_GET["datewrong"]) ?
'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Tanggal pengembalian tidak boleh <strong>lebih kecil</strong> atau <strong>sama dengan</strong> hari pengembalian 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>' 
: ''
?>

<div class="col-md-12">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary-emphasis">Detail Buku</strong>
        <h3 class="mb-0"><?= $getData["Judul"] ?></h3>
        <div class="mb-1 text-body-secondary">Nov 12</div>
        <p class="card-text mb-3"><?= $getData["Deskripsi"] ?></p>
        <b class="card-text mb-2">Kategori : </b>
        <p class="card-text mb-auto">
        <?php
          $n = explode(', ', $getData["kategori"] ?? '');
          foreach($n as $row) echo "<button class='btn btn-success btn-sm me-1'>$row</button>";
        ?>
        </p>
        <div class="d-flex justify-content-between">
          <a type="button" class="icon-link gap-1 icon-link-hover" data-bs-toggle="modal" data-bs-target="#pinjam">
            Pinjam Sekarang
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
          <a type="button" class="btn fs-5" data-bs-toggle="modal" data-bs-target="#ulasan">
            <i class="bi bi-chat-left-dots"></i>
          </a>
        </div>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img src="../assets/image/" alt="">
      </div>
    </div>
</div>


<!-- Modal Pinjam -->
<div class="modal fade" id="pinjam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Tanggal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
        <div class="mb-3">
            <label for="tanggalPinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" name="tanggalPinjam" id="tanggalPinjam" value="<?php echo date('Y-m-d'); ?>" readonly>
        </div>          
        <div class="mb-3">
            <label for="tanggalKembali" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" name="tanggalKembali" id="tanggalKembali" required>
        </div>          
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="sdsubmit" name="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- /Modal Pinjam -->

<!-- Modal Ulasan -->
<div class="modal fade" id="ulasan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ulasan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="form-group mb-3">
              <textarea class="form-control mb-3" name="ulasan" placeholder="Submit Ulasan" cols="5" reuired></textarea>
              <select name="rating" class="form-select col-md-1" width="30" required>
                <option value="">Pilih rating</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          <button class="btn btn-primary w-100" type="submit" name="submitulasan" id="button-addon2">Submit</button>
        </form>
    </div>
  </div>
</div>
</div>
<!-- /Modal Ulasan -->