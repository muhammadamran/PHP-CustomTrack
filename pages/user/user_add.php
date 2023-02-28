<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Tambah User</h5>
        </div>
        <div class="card-body ">
            <form action="pages/user/user_proses.php?aksi=insert" method="POST">
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Nama</label>
                    <input id="inputText3" name="nama" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Email</label>
                    <input id="inputText3" name="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Username</label>
                    <input id="inputText3" name="username" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Password</label>
                    <input id="inputText3" name="password" type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Expired Date</label>
                    <input id="inputText3" name="expired_date" type="date" min="<?= date('Y-m-d') ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role" class="col-form-label">Role</label>
                    <select class="form-control" name="role">
                        <option>-- Pilih Role --</option>
                        <option value="admin">Administrator</option>
                        <option value="member">Member</option>
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