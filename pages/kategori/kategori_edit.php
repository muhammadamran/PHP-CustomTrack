<?php
    $data = $db->query('SELECT * FROM kategori WHERE id="'.$_GET['id'].'"');
    $row = $data->fetch_assoc()
?>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Update Kategori</h5>
        </div>
        <div class="card-body ">
            <form action="pages/kategori/kategori_proses.php?aksi=update&id=<?= $_GET['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Nama Kategori</label>
                    <input id="inputText3" name="nama_kategori" type="text" value="<?= $row['nama_kategori'] ?>" class="form-control">
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