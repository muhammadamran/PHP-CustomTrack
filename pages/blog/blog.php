<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">News & Artikel</h5>
        </div>
        <div class="card-body ">
            <a href="index.php?m=blog&s=blog_add&tipe=<?= $_GET['tipe'] ?>" class="btn btn-primary">Tambah News & Artikel</a>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>Image</th>
                      <th>Tipe</th>
                      <th>Title</th>
                      <th>Sinopsis</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $data = $db->query("SELECT a.id, a.image, a.tipe, a.title, a.sinopsis, b.nama_kategori FROM blog a JOIN kategori b ON a.kategori_id-b.id
                      WHERE a.tipe='".$_GET['tipe']."' ORDER BY a.created_date DESC", 0);

                      while($row = $data->fetch_assoc()) {
                  ?>
                  <tr>
                      <td>
                        <img src="assets/uploads/blog/<?= $row['image'] ?>" alt="Image Blog" width="200px;">
                      </td>
                      <td><?= $row['tipe'] == 'news' ? 'News' : 'Artikel' ?></td>
                      <td><?= $row['title'] ?></td>
                      <td><?= $row['sinopsis'] ?></td>
                      <td><?= $row['nama_kategori'] ?></td>
                      <td>
                          <a href="index.php?m=blog&s=blog_edit&id=<?= $row['id'] ?>&tipe=<?= $_GET['tipe'] ?>" class="btn btn-xs btn-primary">Edit</a>
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
      location.href = "pages/blog/blog_proses.php?aksi=hapus&id=" + id;
    }
  }
</script>