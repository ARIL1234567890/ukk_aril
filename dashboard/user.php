<?php 
require_once 'action.php';

$data = new User();

if(isset($_POST["register-user"])){
    $data->register($_POST);
}

?>

<div class="x_panel">
    <!-- Header -->
    <div class="x_title">
        <h2>Data User</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="ml-2">
                <a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- \Header -->

    <!-- Content -->
   

    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                Tambah User
            </button>
            <!-- <a class="btn btn-success" href="registrasi.php"><i class="fa fa-plus"></i> Tambah User</a> -->
                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach($data->get_user() as $rows) : ?>
                                <tr>
                                    <td><?= $rows["Username"] ?? '' ?></td>
                                    <td><?= $rows["Email"] ?? '' ?></td>
                                    <td><?= $rows["NamaLengkap"] ?? '' ?></td>
                                    <td><?= $rows["Alamat"] ?? '' ?></td>
                                    <td><?= $rows["Level"] ?? '' ?></td>
                                    <td>
                                        <a class="btn btn-danger rounded" href="?page=delete-user&id=<?= $rows["UserID"] ?>" onclick="return confirm('Hapus <?= $rows['Username'] ?>?')"><i class="fa fa-trash"></i></a>
                                       
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- \Content -->

</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Username" name="username" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Password" name="password" pattern=".{8,}" required>
            </div>
            <div class="mb-3">
                <select name="level" class="form-control" required>
                    <option value="peminjam">Peminjam</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" type="submit" name="register-user">submit</button>
        </form>
        </div>
    </div>
  </div>
</div>