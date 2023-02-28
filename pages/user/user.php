<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Users</h5>
        </div>
        <div class="card-body ">
          <a href="index.php?m=user&s=user_add" class="btn btn-primary">Tambah User</a>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Expired Date</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data = $db->query("SELECT * FROM user ORDER BY role ASC, nama ASC", 0);

                while ($row = $data->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= !empty($row['expired_date']) ? $row['expired_date'] : 'Tidak ada tanggal kadaluwarsa' ?></td>
                    <td><?= $row['role'] == 'admin' ? 'Administrator' : 'Member' ?></td>
                    <td>
                      <a href="index.php?m=user&s=user_edit&id=<?= $row['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
                      <a href="index.php?m=user&s=user_password&id=<?= $row['id'] ?>" class="btn btn-xs btn-secondary">Change Password</a>
                      <a onclick="deleteData(<?= $row['id'] ?>)" class="btn btn-xs btn-danger" style="color:#fff;cursor:pointer">Hapus</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function deleteData(id) {
    var r = confirm("Anda yakin ingin menghapus ini");
    if (r == true) {
      location.href = "pages/user/user_proses.php?aksi=hapus&id=" + id;
    }
  }
</script>