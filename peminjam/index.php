<?php
require_once ('action.php');

//cek status login dan level user 
isset($_SESSION["login"]) ? 
($_SESSION["login"]["Level"] !== 'peminjam' ? exit(header("location:../dashboard/index.php")) : '') 
: exit(header("location:../index.php"));

$data = new Peminjam();

$getData = $data->getPeminjam();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
  </head>
  <body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container py-3">
      <a class="navbar-brand fw-bolder" href="#"><i class="bi bi-book-half me-1"></i>Digitallibrary</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link <?= !isset($_GET['page']) ? 'active text-danger' : '' ?>" href="index.php"><i class="bi bi-house me-1"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isset($_GET['page']) ? ($_GET['page'] == 'list-pinjaman' ? 'active text-success' : '') : '' ?>" href="?page=list-pinjaman"><i class="bi bi-clock-history me-1"></i>History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isset($_GET['page']) ? ($_GET['page'] == 'koleksi-buku' ? 'active text-warning' : '') : '' ?>" href="?page=koleksi-buku"><i class="bi bi-bookmark me-1"></i>Koleksi</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout<i class="bi bi-box-arrow-right ms-1"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- /Navbar -->

  <nav class="navbar navbar-expand-lg bg-body-transparent">
    <div class="container py-5">&nbsp;</div>
  </nav>

  <div class="container">
    <?php 
      $page = isset($_GET["page"]) ? $_GET["page"] : 'buku';

      $pages = file_exists($page) ? $page : $page;

      include $pages.'.php';
    ?>
  </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>