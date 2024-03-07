<?php
    $result = $data->getBuku($_SESSION["login"]["UserID"]);
?>
<table id="table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
<thead>
    <tr>
    <th>Judul</th>
    <th>Tanggal Peminjaman</th>
    <th>Tanggal Pengembalian</th>
    <th>Buku</th>
    </tr>
</thead>
<tbody>
    <?php foreach($result as $row):  ?>
    <tr>
        <td><?= $row["Judul"] ?></td>
        <td><?= date('d F Y', strtotime($row["TanggalPeminjaman"])) ?></td>
        <td><?= date('d F Y', strtotime($row["TanggalPengembalian"])) ?></td>
        <td><a href="../book/<?= $row['File'] ?>" class="text-decoration-none" target="_blank">lihat</a></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>

<!-- Konfigurasi Datatable -->
<script>
$(document).ready(function() {
    $('#table').DataTable({
    "paging": true, // Aktifkan pagination
    "searching": true, // Aktifkan live search
    "ordering": true, // Aktifkan sorting
    'info': true,
    'scrollX': true,
    'lengthChange': true,
    'autoWidth': false
    });
});
</script>