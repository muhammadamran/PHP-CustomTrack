<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Galeri</h5>
        </div>
        <div class="card-body ">
            <a href="index.php?m=galeri&s=galeri_add" class="btn btn-primary">Tambah Galeri</a>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>Title</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $data = $db->query("SELECT * FROM galeri ORDER BY id DESC", 0);

                      while($row = $data->fetch_assoc()) {
                  ?>
                  <tr>
                      <td><?= $row['title'] ?></td>
                      <td>
                        <img src="assets/uploads/galeri/<?= $row['gambar'] ?>" alt="Image Galeri" width="200px;">
                      </td>
                      <td>
                          <a href="index.php?m=galeri&s=galeri_edit&id=<?= $row['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
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
      location.href = "pages/galeri/galeri_proses.php?aksi=hapus&id=" + id;
    }
  }
</script>