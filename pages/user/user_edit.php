<?php
    $data = $db->query('SELECT * FROM user WHERE id="'.$_GET['id'].'"');
    $row = $data->fetch_assoc()
?>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Update User</h5>
        </div>
        <div class="card-body ">
            <form action="pages/user/user_proses.php?aksi=update&id=<?= $_GET['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Username</label>
                    <input id="inputText3" name="username" type="text" value="<?= $row['username'] ?>" class="form-control" readonly disabled>
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Nama</label>
                    <input id="inputText3" name="nama" type="text" value="<?= $row['nama'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Email</label>
                    <input id="inputText3" name="email" type="email" value="<?= $row['email'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Expired Date</label>
                    <input id="inputText3" name="expired_date" type="date" min="<?= date('Y-m-d') ?>" value="<?= $row['expired_date'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role" class="col-form-label">Role</label>
                    <select class="form-control" name="role">
                        <option>-- Pilih Role --</option>
                        <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                        <option value="member" <?= $row['role'] == 'member' ? 'selected' : '' ?>>Member</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>