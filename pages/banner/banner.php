<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Banners</h5>
        </div>
        <div class="card-body ">
            <a href="index.php?m=banner&s=banner_add" class="btn btn-primary">Tambah Banner</a>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>Image</th>
                      <th>Expired Date</th>
                      <th>Link</th>
                      <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $data = $db->query("SELECT * FROM banner ORDER BY expired_date DESC", 0);

                      while($row = $data->fetch_assoc()) {
                  ?>
                  <tr>
                      <td>
                        <img src="assets/uploads/banner/<?= $row['image'] ?>" alt="Image Banner" width="200px;">
                      </td>
                      <td><?= !empty($row['expired_date']) ? $row['expired_date'] : 'Tidak ada tanggal kadaluwarsa' ?></td>
                      <td><?= !empty($row['link']) ? '<a href="' . $row['link'] . '" target="_blank">' . $row['link'] . '</a>' : 'Tidak ada link' ?></td>
                      <td>
                          <a href="index.php?m=banner&s=banner_edit&id=<?= $row['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
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
      location.href = "pages/banner/banner_proses.php?aksi=hapus&id=" + id;
    }
  }
</script>