<?php
require_once 'action.php';

// instansiasi class buku 
$data = new Book();

// Menangkap id dari url
$id = $_GET["id"];

// Data buku dari variabel $r1 yang dikembalikan
$result = $data->edit($id);

// var_dump($result);
// die;

if(isset($_POST["submit"])){
    $updt = $data->Update($_POST, $id);
}

if(isset($_POST['submitCategory'])){
    $kategori = $_POST["kategori"];
    $data->updateCategory($kategori, $id);
}

?>

<div class="row">
    <div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Input Data Buku Baru</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="ml-2"><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form class="form-label-left input_mask" method="POST">

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Judul Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Judul Buku" name="judul" value="<?= $result["Judul"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Penulis</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Penulis" name="penulis" value="<?= $result["Penulis"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Penerbit</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Penerbit" name="penerbit" value="<?= $result["Penerbit"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Tahun Terbit</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahun" value="<?= $result["TahunTerbit"] ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3">Kategori</label>
                    <div class="col-md-9 col-sm-9">
                        <div class="row">
                            <button type="button" class="btn btn-warning ml-2 btn-sm" data-toggle="modal" data-target="#tambahKategori">Tambah Kategori&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
                        </div>
                            <?php foreach($result["Kategori"] as $rows ) : ?>
                            <span class="btn btn-success position-relative"><?= $rows['NamaKategori'] ?>&nbsp;&nbsp;&nbsp;<a onclick="return confirm('Hapus?')" href="deletekat.php?categoryID=<?=$rows['KategoriBukuID']?>&book=<?=$rows['BukuID']?>">x</a></span>
                            <?php endforeach; ?>
                    </div>

                </div>

                <div class="form-group row">
                    <label  class="col-form-label col-md-3 col-sm-3 ">Deskripsi Buku</label>
                    <div class="col-md-9 col-sm-9 ">
                        <textarea name="deskripsi" class="form-control" id="" cols="10" rows="2" placeholder="Deskripsi Buku"><?= $result["Deskripsi"] ?></textarea>
                    </div>

                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <a class="btn btn-primary" href="?page=buku">Cancel</a>
                        <button type="submit" class="btn btn-danger" name="submit">Simpan Perubahan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST">
        <div class="modal-body">
            <select name="kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php foreach($data->getCategory() as $row) : ?>
                    <?php if(array_column($result['Kategori'], 'KategoriID') !== $row['KategoriID']) :  ?>
                        <option value="<?= $row['KategoriID'] ?>"><?= $row['NamaKategori'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submitCategory">Submit</button>
        </div>
    </form>
    </div>
</div>
</div>