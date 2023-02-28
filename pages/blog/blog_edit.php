<?php
    $data = $db->query('SELECT * FROM blog WHERE id="'.$_GET['id'].'"');
    $row = $data->fetch_assoc()
?>
<div class="content">
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header ">
        <h5 class="card-title">Update Blog</h5>
      </div>
      <div class="card-body ">
          <form action="pages/blog/blog_proses.php?aksi=update&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="tipe" value="<?= $_GET['tipe'] ?>">
              <div class="form-group">
                  <label for="inputText3" class="col-form-label">Image</label>
                  <input id="inputText3" name="image" type="file" class="form-control" style="position:unset;opacity:1">
              </div>
              <div class="form-group">
                  <label for="inputText3" class="col-form-label">Title</label>
                  <input id="inputText3" name="title" type="text" value="<?= $row['title'] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="kategori_id" class="col-form-label">Kategori</label>
                  <select class="form-control" name="kategori_id">
                      <option>-- Pilih Kategori --</option>
                      <?php 
                          $kategori = $db->query("SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori ASC", 0);
                          while($row_kategori = $kategori->fetch_assoc()) {
                      ?>
                        <option value="<?= $row_kategori['id'] ?>" <?= $row['kategori_id'] == $row_kategori['id'] ? 'selected' : '' ?>><?= $row_kategori['nama_kategori'] ?></option>
                      <?php } ?>
                  </select>
              </div>
              <div class="form-group">
                  <label for="inputText3" class="col-form-label">Sinopsis</label>
                  <input id="inputText3" name="sinopsis" type="text" value="<?= $row['sinopsis'] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="content" class="col-form-label">Content</label>
                  <textarea name="content" rows="4" class="ckeditor form-control"><?= $row['title'] ?></textarea>
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
<script src="assets/vendor/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('.ckeditor')
</script>