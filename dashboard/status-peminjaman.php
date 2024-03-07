<?php
require_once 'action.php';

$objct = new Graph();

$data = $objct->reportPeminjam();

if(isset($_POST['update-status'])){
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
    <h2 align="center">STATUS PEMINJAMAN</h2>

<table id="datatable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <th>No</th>
        <th>Peminjam</th>
        <th>Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Pengembalian</th>
        <th>Status</th>
        <th>Aksi</th>
    
    </thead>
    <tbody>
        
        <?php 
        $no = 1;
        foreach($data as $row) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row["Username"] ?></td>
            <td><?= $row["Judul"] ?></td>
            <td><?= date('d-m-Y',strtotime($row["TanggalPeminjaman"])) ?></td>
            <td><?= date('d-m-Y',strtotime($row["TanggalPengembalian"])) ?></td>
            <td><?= $row["StatusPeminjaman"] ?></td>
            <td>
                <?php if($row["StatusPeminjaman"] == "Pinjam") : ?>
                <a href="update-status.php?id=<?= $row["PeminjamanID"] ?>" onclick="return confirm('Yakin Kembalikan?')" class="btn btn-danger">Kembalikan</a>
                <?php else: ?>
                    <p>Dikembalikan</p>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Kembalikan Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Klik simpan untuk mengembalikan buku.</h5>
        <form method="post">
            <input type="text" id="id_status">
            <input type="hidden" name="status" value="Kembali" class="form-control" readonly>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" type="submit" name="update-status">Simpan</button>
        </form>
        </div>
    </div>
  </div>
</div>



<!-- <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.btn-update', function(){
            var status = $(this).attr('data-status_id');

            $('#id_status').val(status);
        });
    });
</script> -->

</body>
</html>